<?php 
/* SVN FILE: $Id$ */
/* Comment Fixture generated on: 2008-06-12 20:06:48 : 1213316448*/

class CommentFixture extends CakeTestFixture {
	var $name = 'Comment';
	var $table = 'comments';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'node_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
			'user_id' => array('type'=>'integer', 'null' => true, 'default' => '0'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 300),
			'email' => array('type'=>'string', 'null' => false),
			'website' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'body' => array('type'=>'text', 'null' => false),
			'html_body' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'user_ip' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 15),
			'user_agent' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 200),
			'referrer' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 200),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'moderated' => array('type'=>'integer', 'null' => true, 'default' => '0', 'length' => 1),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'node_id' => array('column' => 'node_id', 'unique' => 0))
			);
	var $records = array(array(
			'id'  => 1,
			'node_id'  => 1,
			'user_id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'website'  => 'Lorem ipsum dolor sit amet',
			'body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
									phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,
									vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,
									feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.
									Orci aliquet, in lorem et velit maecenas luctus, wisi nulla at, mauris nam ut a, lorem et et elit eu.
									Sed dui facilisi, adipiscing mollis lacus congue integer, faucibus consectetuer eros amet sit sit,
									magna dolor posuere. Placeat et, ac occaecat rutrum ante ut fusce. Sit velit sit porttitor non enim purus,
									id semper consectetuer justo enim, nulla etiam quis justo condimentum vel, malesuada ligula arcu. Nisl neque,
									ligula cras suscipit nunc eget, et tellus in varius urna odio est. Fuga urna dis metus euismod laoreet orci,
									litora luctus suspendisse sed id luctus ut. Pede volutpat quam vitae, ut ornare wisi. Velit dis tincidunt,
									pede vel eleifend nec curabitur dui pellentesque, volutpat taciti aliquet vivamus viverra, eget tellus ut
									feugiat lacinia mauris sed, lacinia et felis.',
			'html_body'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
									phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,
									vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,
									feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.
									Orci aliquet, in lorem et velit maecenas luctus, wisi nulla at, mauris nam ut a, lorem et et elit eu.
									Sed dui facilisi, adipiscing mollis lacus congue integer, faucibus consectetuer eros amet sit sit,
									magna dolor posuere. Placeat et, ac occaecat rutrum ante ut fusce. Sit velit sit porttitor non enim purus,
									id semper consectetuer justo enim, nulla etiam quis justo condimentum vel, malesuada ligula arcu. Nisl neque,
									ligula cras suscipit nunc eget, et tellus in varius urna odio est. Fuga urna dis metus euismod laoreet orci,
									litora luctus suspendisse sed id luctus ut. Pede volutpat quam vitae, ut ornare wisi. Velit dis tincidunt,
									pede vel eleifend nec curabitur dui pellentesque, volutpat taciti aliquet vivamus viverra, eget tellus ut
									feugiat lacinia mauris sed, lacinia et felis.',
			'user_ip'  => 'Lorem ipsum d',
			'user_agent'  => 'Lorem ipsum dolor sit amet',
			'referrer'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2008-06-12 20:20:48',
			'moderated'  => 1
			));
}
?>