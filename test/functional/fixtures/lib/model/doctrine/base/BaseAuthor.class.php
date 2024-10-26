<?php

/**
 * ##COPYRIGHT PLACEHOLDER##
 */

/**

 * BaseAuthor
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property string $name
 * @property string $type
 * @property Doctrine_Collection $Articles
 * @property string $id
 *
 * @method string              getName($load = true) Returns the current record's "name" value
 * @method string              getType($load = true) Returns the current record's "type" value
 * @method Doctrine_Collection getArticles($load = true) Returns the current record's "Articles" collection
 * @method string              getId($load = true) Returns the current record's "id" value
 * @method Author              setName($value, $load = true) Sets the current record's "name" value
 * @method Author              setType($value, $load = true) Sets the current record's "type" value
 * @method Author              setArticles($value, $load = true) Sets the current record's "Articles" collection
 * @method Author              setId($value, $load = true) Sets the current record's "id" value
 *
 */
abstract class BaseAuthor extends myDoctrineRecord
{

    public function setTableDefinition()
    {
        $this->setTableName('author');
        $this->hasColumn('name', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));
        $this->hasColumn('type', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
        ));

        $this->setSubClasses(array(
            'AuthorInheritance' =>
            array(
                'type' => 'AuthorInheritance',
            ),
            'BlogAuthor' =>
            array(
                'type' => 'BlogAuthor',
            ),
        ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Article as Articles', array(
            'local' => 'id',
            'foreign' => 'author_id'));
    }

}
