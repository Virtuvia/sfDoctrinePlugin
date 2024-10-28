<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**
 
 * BaseFormGeneratorTest3
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $name
 * @property string $id
 *
 * @method string             getName($load = true) Returns the current record's "name" value
 * @method string             getId($load = true) Returns the current record's "id" value
 * @method FormGeneratorTest3 setName($value, $load = true) Sets the current record's "name" value
 * @method FormGeneratorTest3 setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseFormGeneratorTest3 extends myDoctrineRecord
{

    public function setTableDefinition()
    {
        $this->setTableName('form_generator_test3');
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