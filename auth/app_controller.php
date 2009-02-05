<?php
/**
 * Main App Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @copyright		Copyright 2007-2008, 3HN Designs
 * @author			Kevin Lloyd
 */

/**
 * Main App Controller
 *
 * @author	Kevin Lloyd
 */
class AppController extends Controller {

	var $components = array('Auth', 'Cookie');

	/**
	 * Load the Authentication
	 *
	 * @access public
	 */
	function beforeFilter() {
		//Set up Auth Component
		$this->Auth->autoRedirect = false;
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
		$this->Auth->loginRedirect = '/';
		$this->Auth->logoutRedirect = '/';
		$this->Auth->allow('display');
		$this->Auth->authorize = 'controller';
		$this->Auth->userScope = array('User.active' => 1); //user needs to be active.
		$this->set('user_id', $this->Auth->user('id'));

		if (isset($this->params[Configure::read('Routing.admin')])) {
			$this->Auth->deny('*');
			//$this->layout = 'cake';
			$this->set('admin', true);
		} else {
			$this->set('admin', false);
		}
	}

/**
 * Handles cookie used for Session expiration and set's like of permitted controllers: permittedControllers for views
 * Useful for menu building.
 *
 */
	function beforeRender() {
		$loggedIn = $this->Cookie->read('Auth.UserLogged');
		if ($this->Auth->user()) {
			if (!isset($loggedIn)) {
				$this->Cookie->write('Auth.UserLogged', 'Logged in');
			}
		}
		elseif (isset($loggedIn)) {
			$this->Cookie->del('Auth.UserLogged');
			$this->Session->setFlash('Session Expired');
		}

		//If we have an authorised user logged then pass over an array of controllers
		//to which they have index action permission
		if($this->Auth->user()){
			$controllerList = Configure::listObjects('controller');
			$permittedControllers = array();
			foreach($controllerList as $controllerItem){
				if($controllerItem <> 'App'){
					if($this->__permitted($controllerItem,'index')){
						$permittedControllers[] = $controllerItem;
					}
				}
			}
		}
		$this->set(compact('permittedControllers'));
	}

	/**
	 * isAuthorized
	 *
	 * Called by Auth component for establishing whether the current authenticated
	 * user has authorization to access the current controller:action
	 *
	 * @return true if authorised/false if not authorized
	 * @access public
	 */
	function isAuthorized(){
		return $this->__permitted($this->name,$this->action);
	}

	/**
	 * __permitted
	 *
	 * Helper function returns true if the currently authenticated user has permission
	 * to access the controller:action specified by $controllerName:$actionName
	 *
	 * Taken from {@link http://www.studiocanaria.com/articles/cakephp_auth_component_users_groups_permissions_revisited}
	 *
	 * @return
	 * @param $controllerName Object
	 * @param $actionName Object
	 */
	function __permitted($controllerName,$actionName){
		//Ensure checks are all made lower case
		$controllerName = low($controllerName);
		$actionName = low($actionName);
		//If permissions have not been cached to session...
		if(!$this->Session->check('Permissions')){
			//...then build permissions array and cache it
			$permissions = array();
			//everyone gets permission to logout
			$permissions[]='users:logout';
			//Import the User Model so we can build up the permission cache
			App::import('Model', 'User');
			$thisUser = new User;
			//Now bring in the current users full record along with groups
			$thisUser->contain(array('Group.id'));
			$thisGroups = $thisUser->find(array('User.id'=>$this->Auth->user('id')), 'id');
			$thisGroups = $thisGroups['Group'];
			$thisUser->Group->contain(false, array('Permission.name'));
			foreach($thisGroups as $thisGroup){
				$thisPermissions = $thisUser->Group->find(array('Group.id'=>$thisGroup['id']), 'id');
				$thisPermissions = $thisPermissions['Permission'];
				foreach($thisPermissions as $thisPermission){
					$permissions[]=low($thisPermission['name']);
				}
			}
			//write the permissions array to session
			$this->Session->write('Permissions',$permissions);
		}else{
			//...they have been cached already, so retrieve them
			$permissions = $this->Session->read('Permissions');
		}
		//Now iterate through permissions for a positive match
		foreach($permissions as $permission){
			if($permission == '*'){
				return true;//Super Admin Bypass Found
			}
			if($permission == $controllerName.':*'){
				return true;//Controller Wide Bypass Found
			}
			if($permission == $controllerName.':'.$actionName){
				return true;//Specific permission found
			}
		}
		return false;
	}

}
?>