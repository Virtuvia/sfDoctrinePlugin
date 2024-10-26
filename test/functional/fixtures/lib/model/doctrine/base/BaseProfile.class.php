<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseProfile
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property User $User
 * @property string $id
 *
 * @method string  getUserId($load = true) Returns the current record's "user_id" value
 * @method string  getFirstName($load = true) Returns the current record's "first_name" value
 * @method string  getLastName($load = true) Returns the current record's "last_name" value
 * @method User    getUser($load = true) Returns the current record's "User" value
 * @method string  getId($load = true) Returns the current record's "id" value
 * @method Profile setUserId($value, $load = true) Sets the current record's "user_id" value
 * @method Profile setFirstName($value, $load = true) Sets the current record's "first_name" value
 * @method Profile setLastName($value, $load = true) Sets the current record's "last_name" value
 * @method Profile setUser($value, $load = true) Sets the current record's "User" value
 * @method Profile setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseProfile extends myDoctrineRecord
{

    public function setTableDefinition()
    {
        $this->setTableName('profile');
        $this->hasColumn('user_id', 'integer', null, array(
            'type' => 'integer',
        ));
        $this->hasColumn('first_name', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));
        $this->hasColumn('last_name', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
            'local' => 'user_id',
            'foreign' => 'id'));
    }

}
