<?php 
/* SVN FILE: $Id$ */
/* PostsController Test cases generated on: 2008-07-05 15:07:52 : 1215286372*/
App::import('Controller', 'Posts');

class TestPosts extends PostsController {
	var $autoRender = false;
}

class PostsControllerTest extends CakeTestCase {
	var $Posts = null;

	function setUp() {
		$this->Posts = new TestPosts();
		$this->Posts->constructClasses();
	}

	function testPostsControllerInstance() {
		$this->assertTrue(is_a($this->Posts, 'PostsController'));
	}

	function tearDown() {
		unset($this->Posts);
	}
}
?>