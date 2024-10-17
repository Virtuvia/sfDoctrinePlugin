<?php

declare(strict_types=1);

abstract class Doctrine_Record_Internals extends Doctrine_Record_Abstract
{
    abstract protected function setInternalData(string $fieldName, mixed $value, bool $load = true): void;

    abstract protected function setInternalValue(string $fieldName, mixed $value): void;

    abstract protected function setInternalReference(string $fieldName, Doctrine_Record|Doctrine_Collection|null $value): void;
}
