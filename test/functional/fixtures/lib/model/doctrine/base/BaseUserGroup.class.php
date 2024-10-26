<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseUserGroup
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $user_id
 * @property string $group_id
 *
 * @method string    getUserId($load = true) Returns the current record's "user_id" value
 * @method string    getGroupId($load = true) Returns the current record's "group_id" value
 * @method UserGroup setUserId($value, $load = true) Sets the current record's "user_id" value
 * @method UserGroup setGroupId($value, $load = true) Sets the current record's "group_id" value
 *
 */
abstract class BaseUserGroup extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_group');
        $this->hasColumn('user_id', 'integer', null, [
            'type' => 'integer',
            'primary' => true,
        ]);
        $this->hasColumn('group_id', 'integer', null, [
            'type' => 'integer',
            'primary' => true,
        ]);

        $this->option('symfony', [
            'form' => false,
            'filter' => false,
        ]);
    }

    public function setUp()
    {
        parent::setUp();

    }

}
