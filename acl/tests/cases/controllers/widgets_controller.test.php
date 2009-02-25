<?php 
/* SVN FILE: $Id$ */
/* WidgetsController Test cases generated on: 2008-07-05 15:07:26 : 1215286406*/
App::import('Controller', 'Widgets');

class TestWidgets extends WidgetsController {
	var $autoRender = false;
}

class WidgetsControllerTest extends CakeTestCase {
	var $Widgets = null;

	function setUp() {
		$this->Widgets = new TestWidgets();
		$this->Widgets->constructClasses();
	}

	function testWidgetsControllerInstance() {
		$this->assertTrue(is_a($this->Widgets, 'WidgetsController'));
	}

	function tearDown() {
		unset($this->Widgets);
	}
}
?>