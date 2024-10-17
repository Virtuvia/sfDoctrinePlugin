<?php

declare(strict_types=1);

final class Doctrine_Record_InternalsProxy extends Doctrine_Record_Internals
{
    public Doctrine_Record $record;

    public function __construct()
    {
    }

    public function setTableDefinition()
    {
        throw new \LogicException();
    }

    public function setUp(): void
    {
        throw new \LogicException();
    }

    public function setData(string $fieldName, mixed $value, bool $load = true): void
    {
        $mutator = 'set' . Doctrine_Inflector::classify($fieldName);

        if (method_exists($this, $mutator)) {
            $this->record->$mutator($value, $load, $fieldName);
        }

        $this->record->setInternalData($fieldName, $value, $load);
    }

    public function setReference(string $relationAlias, Doctrine_Record|Doctrine_Collection|null $value, bool $load = true): void
    {
        $mutator = 'set' . Doctrine_Inflector::classify($relationAlias);

        if (method_exists($this->record, $mutator)) {
            $this->record->$mutator($value, $load, $relationAlias);
        }

        $this->record->setInternalReference($relationAlias, $value);
    }

    protected function setInternalData(string $fieldName, mixed $value, bool $load = true): void
    {
        $this->record->setInternalData($fieldName, $value, $load);
    }

    protected function setInternalValue(string $fieldName, mixed $value): void
    {
        $this->record->setInternalValue($fieldName, $value);
    }

    protected function setInternalReference(string $fieldName, Doctrine_Record|Doctrine_Collection|null $value): void
    {
        $this->record->setInternalReference($fieldName, $value);
    }
}

