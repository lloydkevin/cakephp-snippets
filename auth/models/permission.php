<?php
class Permission extends AppModel {
	var $name = 'Permission';
	var $validate = array(
		'name' => array('rule' => array('minLength', 1), 'required' => true),
	);
	var $hasAndBelongsToMany = array(
            'Group' => array('className' => 'Group',
                        'joinTable' => 'groups_permissions',
                        'foreignKey' => 'permission_id',
                        'associationForeignKey' => 'group_id',
                        'unique' => true
		)
	);
	var $actsAs = array('Containable'); 
}

?>