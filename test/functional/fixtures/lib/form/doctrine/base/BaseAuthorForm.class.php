<?php

/**
 * Author form base class.
 *
 * @method     Author getObject() Returns the current form's model object
 * @property   Author $object The current form's model object
 *
 * @package    symfony12
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAuthorForm extends BaseFormDoctrine
{
    public function setup()
    {
        $this->setWidgets(array(
            'id'   => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'type' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('author[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Author';
    }
}
