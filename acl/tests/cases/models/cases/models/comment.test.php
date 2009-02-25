<?php 
/* SVN FILE: $Id$ */
/* Comment Test cases generated on: 2008-06-01 23:06:11 : 1212378611*/
App::import('Model', 'Comment');
class TestComment extends Comment {

	var $cacheSources = false;
}

class CommentTest extends CakeTestCase {

	function start() {
		parent::start();
		$this->Comment = new TestComment();
	}

	function testCommentInstance() {
		$this->assertTrue(is_a($this->Comment, 'Comment'));
	}

	function testComment() {

	}

	function testComment.test.php() {

	}
}
?>