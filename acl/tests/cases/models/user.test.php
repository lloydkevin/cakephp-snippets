<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2008-07-05 15:07:13 : 1215286213*/
App::import('Model', 'User');

class TestUser extends User {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class UserTestCase extends CakeTestCase {
	var $User = null;
	var $fixtures = array('app.user', 'app.group', 'app.post');

	function start() {
		parent::start();
		$this->User = new TestUser();
	}

	function testUserInstance() {
		$this->assertTrue(is_a($this->User, 'User'));
	}

	function testUserFind() {
		$results = $this->User->recursive = -1;
		$results = $this->User->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('User' => array(
			'id'  => 1,
			'username'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'group_id'  => 1,
			'created'  => '2008-07-05 15:30:13',
			'modified'  => '2008-07-05 15:30:13'
			));
		$this->assertEqual($results, $expected);
	}
}
?>