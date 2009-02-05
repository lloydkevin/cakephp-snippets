<?php
class AppController extends Controller {


	function beforeFilter(){
		$this->fetchSettings();
	}
	/**
	 * Load settings into Configure class from the database.
	 *
	 */
	function fetchSettings(){
		if ((!Configure::read('Settings.loaded'))) { // Read only once - Not in requestActions
			//Loading model on the fly
			App::import('Model', 'Setting');
			$settings = new Setting();
			$settings_array = Set::combine($settings->find('all', array('fields' => array('key','value'))), '{n}.Setting.key', '{n}.Setting.value');
			Configure::write($settings_array);
			Configure::write('Settings.loaded', true);
		}
	}
}
?>