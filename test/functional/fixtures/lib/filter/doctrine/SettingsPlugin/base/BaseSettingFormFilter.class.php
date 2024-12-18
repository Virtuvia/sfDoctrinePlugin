<?php

/**
 * Setting filter form base class.
 *
 * @package    symfony12
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSettingFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets([
            'name'       => new sfWidgetFormFilterInput(['with_empty' => false]),
            'value'      => new sfWidgetFormFilterInput(),
            'weight'     => new sfWidgetFormFilterInput(),
            'created_at' => new sfWidgetFormFilterDate(['from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false]),
        ]);

        $this->setValidators([
            'name'       => new sfValidatorPass(['required' => false]),
            'value'      => new sfValidatorPass(['required' => false]),
            'weight'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(['required' => false])),
            'created_at' => new sfValidatorDateRange(['required' => false, 'from_date' => new sfValidatorDateTime(['required' => false, 'datetime_output' => 'Y-m-d 00:00:00']), 'to_date' => new sfValidatorDateTime(['required' => false, 'datetime_output' => 'Y-m-d 23:59:59'])]),
        ]);

        $this->widgetSchema->setNameFormat('setting_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Setting';
    }

    public function getFields()
    {
        return [
            'id'         => 'Number',
            'name'       => 'Text',
            'value'      => 'Text',
            'weight'     => 'Number',
            'created_at' => 'Date',
        ];
    }
}
