<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseAttachment
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $file_path
 * @property string $id
 *
 * @method string     getFilePath($load = true) Returns the current record's "file_path" value
 * @method string     getId($load = true) Returns the current record's "id" value
 * @method Attachment setFilePath($value, $load = true) Sets the current record's "file_path" value
 * @method Attachment setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseAttachment extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('attachment');
        $this->hasColumn('file_path', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));
    }

    public function setUp()
    {
        parent::setUp();

    }

}
