<?php

/**
 * Attachment form base class.
 *
 * @method     Attachment getObject() Returns the current form's model object
 * @property   Attachment $object The current form's model object
 *
 * @package    symfony12
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAttachmentForm extends BaseFormDoctrine
{
    public function setup()
    {
        $this->setWidgets([
            'id'        => new sfWidgetFormInputHidden(),
            'file_path' => new sfWidgetFormInputText(),
        ]);

        $this->setValidators([
            'id'        => new sfValidatorChoice(['choices' => [$this->getObject()->get('id')], 'empty_value' => $this->getObject()->get('id'), 'required' => false]),
            'file_path' => new sfValidatorString(['max_length' => 255, 'required' => false]),
        ]);

        $this->widgetSchema->setNameFormat('attachment[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Attachment';
    }
}
