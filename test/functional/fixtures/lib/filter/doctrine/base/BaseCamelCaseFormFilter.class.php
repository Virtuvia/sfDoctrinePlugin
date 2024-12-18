<?php

/**
 * CamelCase filter form base class.
 *
 * @package    symfony12
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCamelCaseFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets([
            'article_id'    => new sfWidgetFormDoctrineChoice(['model' => $this->getRelatedModelName('Article'), 'add_empty' => true]),
            'testCamelCase' => new sfWidgetFormFilterInput(),
        ]);

        $this->setValidators([
            'article_id'    => new sfValidatorDoctrineChoice(['required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id']),
            'testCamelCase' => new sfValidatorPass(['required' => false]),
        ]);

        $this->widgetSchema->setNameFormat('camel_case_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'CamelCase';
    }

    public function getFields()
    {
        return [
            'id'            => 'Number',
            'article_id'    => 'ForeignKey',
            'testCamelCase' => 'Text',
        ];
    }
}
