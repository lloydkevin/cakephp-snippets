<?php 
/**
* 
*/
class AppController extends Controller {
	var $components = array('Auth', 'Acl');
	
	function beforeFilter() {
		//Configure AuthComponent
		$this->Auth->authorize = 'actions';
		$this->Auth->actionPath = 'controllers/';
		
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add');
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
	}
	
/**
 * Rebuild the Acl based on the current controllers in the application
 *
 * @return void
 */
	function buildAcl() {
		$log = array();
		
		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id; 
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}	
		
		App::import('Core', 'File');
		$dir = new Folder(CONTROLLERS);
		list($dirs, $Controllers) = $dir->ls();
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'buildAcl';
		
		// look at each controller in app/controllers
		foreach ($Controllers as $Controller) {
			$ctrlName = Inflector::camelize(substr($Controller, 0, strpos($Controller, 'controller') -1));
			
			App::import('Controller', $ctrlName);
			$ctrlclass = $ctrlName . 'Controller';
			$methods = get_class_methods($ctrlclass);
			
			// find / make controller node
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode) {
				$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
				$controllerNode = $aco->save();
				$controllerNode['Aco']['id'] = $aco->id;
				$log[] = 'Created Aco node for '.$ctrlName;
			} else {
				$controllerNode = $controllerNode[0];
			}
		
			//clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode) {
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for '. $method;
				}
			}
		}
		debug($log);
	}
}
