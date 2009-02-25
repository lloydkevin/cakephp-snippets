<?php
class WidgetsController extends AppController {

	var $name = 'Widgets';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter() {
		parent::beforeFilter();	
		$this->Auth->allowedActions = array('index', 'view');
	}

	function index() {
		$this->Widget->recursive = 0;
		$this->set('widgets', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Widget.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('widget', $this->Widget->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Widget->create();
			if ($this->Widget->save($this->data)) {
				$this->Session->setFlash(__('The Widget has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Widget could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Widget', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Widget->save($this->data)) {
				$this->Session->setFlash(__('The Widget has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Widget could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Widget->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Widget', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Widget->del($id)) {
			$this->Session->setFlash(__('Widget deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>