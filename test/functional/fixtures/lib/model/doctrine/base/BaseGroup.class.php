<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**
 
 * BaseGroup
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $name
 * @property Doctrine_Collection $Permissions
 * @property Doctrine_Collection $Users
 * @property string $id
 *
 * @method string              getName($load = true) Returns the current record's "name" value
 * @method Doctrine_Collection getPermissions($load = true) Returns the current record's "Permissions" collection
 * @method Doctrine_Collection getUsers($load = true) Returns the current record's "Users" collection
 * @method string              getId($load = true) Returns the current record's "id" value
 * @method Group               setName($value, $load = true) Sets the current record's "name" value
 * @method Group               setPermissions($value, $load = true) Sets the current record's "Permissions" collection
 * @method Group               setUsers($value, $load = true) Sets the current record's "Users" collection
 * @method Group               setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseGroup extends myDoctrineRecord
{

    public function setTableDefinition()
    {
        $this->setTableName('groups');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Permission as Permissions', [
             'refClass' => 'GroupPermission',
             'local' => 'group_id',
             'foreign' => 'permission_id']);

        $this->hasMany('User as Users', [
             'refClass' => 'UserGroup',
             'local' => 'group_id',
             'foreign' => 'user_id']);
    }

}