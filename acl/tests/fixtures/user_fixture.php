<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2008-07-05 15:07:13 : 1215286213*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'username' => array('type'=>'string', 'null' => false, 'key' => 'unique'),
			'password' => array('type'=>'string', 'null' => false, 'length' => 40),
			'group_id' => array('type'=>'integer', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'username'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'group_id'  => 1,
			'created'  => '2008-07-05 15:30:13',
			'modified'  => '2008-07-05 15:30:13'
			));
}
?>