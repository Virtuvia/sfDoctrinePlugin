<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseUser
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $username
 * @property string $password
 * @property string $test
 * @property Doctrine_Collection $Groups
 * @property Doctrine_Collection $Permissions
 * @property Profile $Profile
 * @property string $id
 *
 * @method string              getUsername($load = true) Returns the current record's "username" value
 * @method string              getPassword($load = true) Returns the current record's "password" value
 * @method string              getTest($load = true) Returns the current record's "test" value
 * @method Doctrine_Collection getGroups($load = true) Returns the current record's "Groups" collection
 * @method Doctrine_Collection getPermissions($load = true) Returns the current record's "Permissions" collection
 * @method Profile             getProfile($load = true) Returns the current record's "Profile" value
 * @method string              getId($load = true) Returns the current record's "id" value
 * @method User                setUsername($value, $load = true) Sets the current record's "username" value
 * @method User                setPassword($value, $load = true) Sets the current record's "password" value
 * @method User                setTest($value, $load = true) Sets the current record's "test" value
 * @method User                setGroups($value, $load = true) Sets the current record's "Groups" collection
 * @method User                setPermissions($value, $load = true) Sets the current record's "Permissions" collection
 * @method User                setProfile($value, $load = true) Sets the current record's "Profile" value
 * @method User                setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseUser extends myDoctrineRecord
{

    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('username', 'string', 255, array(
            'type' => 'string',
            'unique' => true,
            'length' => 255,
        ));
        $this->hasColumn('password', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));
        $this->hasColumn('test', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Group as Groups', array(
            'refClass' => 'UserGroup',
            'local' => 'user_id',
            'foreign' => 'group_id'));

        $this->hasMany('Permission as Permissions', array(
            'refClass' => 'UserPermission',
            'local' => 'user_id',
            'foreign' => 'permission_id'));

        $this->hasOne('Profile', array(
            'local' => 'id',
            'foreign' => 'user_id'));
    }

}
