<?php

/**
 * BaseFormGeneratorTest2
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * 
 * @method string             getName() Returns the current record's "name" value
 * @method FormGeneratorTest2 setName() Sets the current record's "name" value
 * 
 * @package    symfony12
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseFormGeneratorTest2 extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('form_generator_test2');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}