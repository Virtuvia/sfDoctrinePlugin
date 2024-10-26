<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseModelWithNumberInColumn
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $column_1
 * @property string $column2
 * @property string $column__3
 * @property string $id
 *
 * @method string                  getColumn1($load = true) Returns the current record's "column_1" value
 * @method string                  getColumn2($load = true) Returns the current record's "column2" value
 * @method string                  getColumn3($load = true) Returns the current record's "column__3" value
 * @method string                  getId($load = true) Returns the current record's "id" value
 * @method ModelWithNumberInColumn setColumn1($value, $load = true) Sets the current record's "column_1" value
 * @method ModelWithNumberInColumn setColumn2($value, $load = true) Sets the current record's "column2" value
 * @method ModelWithNumberInColumn setColumn3($value, $load = true) Sets the current record's "column__3" value
 * @method ModelWithNumberInColumn setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseModelWithNumberInColumn extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('model_with_number_in_column');
        $this->hasColumn('column_1', 'string', 255, [
            'type' => 'string',
            'length' => 255,
        ]);
        $this->hasColumn('column2', 'string', 255, [
            'type' => 'string',
            'length' => 255,
        ]);
        $this->hasColumn('column__3', 'string', 255, [
            'type' => 'string',
            'length' => 255,
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
