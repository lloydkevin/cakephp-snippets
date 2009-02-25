<?php 
/* SVN FILE: $Id$ */
/* Group Test cases generated on: 2008-07-05 15:07:38 : 1215286178*/
App::import('Model', 'Group');

class TestGroup extends Group {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class GroupTestCase extends CakeTestCase {
	var $Group = null;
	var $fixtures = array('app.group', 'app.user');

	function start() {
		parent::start();
		$this->Group = new TestGroup();
	}

	function testGroupInstance() {
		$this->assertTrue(is_a($this->Group, 'Group'));
	}

	function testGroupFind() {
		$results = $this->Group->recursive = -1;
		$results = $this->Group->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Group' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2008-07-05 15:29:37',
			'modified'  => '2008-07-05 15:29:37'
			));
		$this->assertEqual($results, $expected);
	}
}
?>