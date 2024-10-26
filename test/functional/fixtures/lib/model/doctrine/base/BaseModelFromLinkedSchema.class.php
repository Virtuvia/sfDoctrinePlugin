<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseModelFromLinkedSchema
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $name
 * @property string $id
 *
 * @method string                getName($load = true) Returns the current record's "name" value
 * @method string                getId($load = true) Returns the current record's "id" value
 * @method ModelFromLinkedSchema setName($value, $load = true) Sets the current record's "name" value
 * @method ModelFromLinkedSchema setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseModelFromLinkedSchema extends myDoctrineRecord
{

    public function setTableDefinition()
    {
        $this->setTableName('model_from_linked_schema');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
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
