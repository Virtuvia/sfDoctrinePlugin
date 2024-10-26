<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseUserPermission
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $user_id
 * @property string $permission_id
 *
 * @method string         getUserId($load = true) Returns the current record's "user_id" value
 * @method string         getPermissionId($load = true) Returns the current record's "permission_id" value
 * @method UserPermission setUserId($value, $load = true) Sets the current record's "user_id" value
 * @method UserPermission setPermissionId($value, $load = true) Sets the current record's "permission_id" value
 *
 */
abstract class BaseUserPermission extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_permission');
        $this->hasColumn('user_id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));
        $this->hasColumn('permission_id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));

        $this->option('symfony', array(
            'form' => false,
            'filter' => false,
        ));
    }

    public function setUp()
    {
        parent::setUp();

    }

}
