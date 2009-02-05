<?php
class Group extends AppModel {

	var $name = 'Group';
	var $validate = array(
		'name' => array('rule' => array('minLength', 1), 'required' => true),
	);
	var $actsAs = array('Sluggable' => array('label' => 'name', 'overwrite' => true), 'Containable'); 

	var $hasAndBelongsToMany = array(
            'Permission' => array('className' => 'Permission',
                        'joinTable' => 'groups_permissions',
                        'foreignKey' => 'group_id',
                        'associationForeignKey' => 'permission_id',
                        'unique' => true
		),
            'User' => array('className' => 'User',
                        'joinTable' => 'groups_users',
                        'foreignKey' => 'group_id',
                        'associationForeignKey' => 'user_id',
                        'unique' => true
		)
	);

}
?>
