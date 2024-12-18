<?php

/**
 * Group filter form base class.
 *
 * @package    symfony12
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGroupFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets([
            'name'             => new sfWidgetFormFilterInput(),
            'permissions_list' => new sfWidgetFormDoctrineChoice(['multiple' => true, 'model' => 'Permission']),
            'users_list'       => new sfWidgetFormDoctrineChoice(['multiple' => true, 'model' => 'User']),
        ]);

        $this->setValidators([
            'name'             => new sfValidatorPass(['required' => false]),
            'permissions_list' => new sfValidatorDoctrineChoice(['multiple' => true, 'model' => 'Permission', 'required' => false]),
            'users_list'       => new sfValidatorDoctrineChoice(['multiple' => true, 'model' => 'User', 'required' => false]),
        ]);

        $this->widgetSchema->setNameFormat('group_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
    {
        if (!is_array($values)) {
            $values = [$values];
        }

        if (!count($values)) {
            return;
        }

        $query
            ->leftJoin($query->getRootAlias() . '.GroupPermission GroupPermission')
            ->andWhereIn('GroupPermission.permission_id', $values)
        ;
    }

    public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
    {
        if (!is_array($values)) {
            $values = [$values];
        }

        if (!count($values)) {
            return;
        }

        $query
            ->leftJoin($query->getRootAlias() . '.UserGroup UserGroup')
            ->andWhereIn('UserGroup.user_id', $values)
        ;
    }

    public function getModelName()
    {
        return 'Group';
    }

    public function getFields()
    {
        return [
            'id'               => 'Number',
            'name'             => 'Text',
            'permissions_list' => 'ManyKey',
            'users_list'       => 'ManyKey',
        ];
    }
}
