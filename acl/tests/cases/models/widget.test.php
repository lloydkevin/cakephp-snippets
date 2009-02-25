<?php 
/* SVN FILE: $Id$ */
/* Widget Test cases generated on: 2008-07-05 15:07:26 : 1215286226*/
App::import('Model', 'Widget');

class TestWidget extends Widget {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class WidgetTestCase extends CakeTestCase {
	var $Widget = null;
	var $fixtures = array('app.widget');

	function start() {
		parent::start();
		$this->Widget = new TestWidget();
	}

	function testWidgetInstance() {
		$this->assertTrue(is_a($this->Widget, 'Widget'));
	}

	function testWidgetFind() {
		$results = $this->Widget->recursive = -1;
		$results = $this->Widget->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Widget' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'part_no'  => 'Lorem ipsu',
			'quantity'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>