<?php 
/* SVN FILE: $Id$ */
/* CommentsController Test cases generated on: 2008-06-12 20:06:10 : 1213316470*/
App::import('Controller', 'Comments');

class TestComments extends CommentsController {
	var $autoRender = false;
}

class CommentsControllerTest extends CakeTestCase {
	var $Comments = null;

	function setUp() {
		$this->Comments = new TestComments();
	}

	function testCommentsControllerInstance() {
		$this->assertTrue(is_a($this->Comments, 'CommentsController'));
	}

	function tearDown() {
		unset($this->Comments);
	}
}
?>