<?php

declare(strict_types=1);

/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

/**
 * Doctrine_Record_Abstract
 *
 * @package     Doctrine
 * @subpackage  Record
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision$
 */
abstract class Doctrine_Record_Abstract
{
    /**
     * @var Doctrine_Table reference to associated Doctrine_Table instance
     */
    protected Doctrine_Table $_table;

    abstract public function setTableDefinition();

    abstract public function setUp();

    /**
     * getTable
     * returns the associated table object
     *
     * @return Doctrine_Table               the associated table object
     */
    final public function getTable(): Doctrine_Table
    {
        return $this->_table;
    }

    final protected function addListener(Doctrine_Record_Listener_Interface $listener, string $name = null): static
    {
        $this->_table->addRecordListener($listener, $name);

        return $this;
    }

    final protected function getListener(): Doctrine_Record_Listener_Interface
    {
        return $this->_table->getRecordListener();
    }

    /**
     * index
     * defines or retrieves an index
     * if the second parameter is set this method defines an index
     * if not this method retrieves index named $name
     *
     * @param string $name              the name of the index
     * @param array $definition         the definition array
     */
    final protected function index(string $name, array $definition = array()): mixed
    {
        if ( ! $definition) {
            return $this->_table->getIndex($name);
        } else {
            return $this->_table->addIndex($name, $definition);
        }
    }

    /**
     * Defines a n-uple of fields that must be unique for every record.
     *
     * This method Will automatically add UNIQUE index definition 
     * and validate the values on save. The UNIQUE index is not created in the
     * database until you use @see export().
     *
     * @param array $fields     values are fieldnames
     * @param array $options    array of options for unique validator
     * @param bool $createUniqueIndex  Whether or not to create a unique index in the database
     */
    final protected function unique(array $fields, array $options = array(), bool $createUniqueIndex = true): void
    {
        $this->_table->unique($fields, $options, $createUniqueIndex);
    }

    public function setAttribute(int|string $attr, mixed $value): void
    {
        $this->_table->setAttribute($attr, $value);
    }

    final protected function setTableName(string $tableName): void
    {
        $this->_table->setTableName($tableName);
    }

    protected function setSubclasses(array $map): void
    {
        $class = get_class($this);
        // Set the inheritance map for subclasses
        if (isset($map[$class])) {
            // fix for #1621
            $mapFieldNames = $map[$class];
            $mapColumnNames = array();

            foreach ($mapFieldNames as $fieldName => $val) {
                $mapColumnNames[$this->getTable()->getColumnName($fieldName)] = $val;
            }
 
            $this->_table->setOption('inheritanceMap', $mapColumnNames);
            return;
        } else {
            // Put an index on the key column
            $mapFieldName = array_keys(end($map));
            $this->index($this->getTable()->getTableName().'_'.$mapFieldName[0], array('fields' => array($mapFieldName[0])));
        }

        // Set the subclasses array for the parent class
        $this->_table->setOption('subclasses', array_keys($map));
    }

    /**
     * option
     * sets or retrieves an option
     *
     * @see Doctrine_Table::$options    availible options
     * @param mixed $name               the name of the option
     * @param mixed $value              options value
     * @return mixed|void
     */
    final protected function option(string $name, mixed $value = null)
    {
        if ($value === null) {
            if (is_array($name)) {
                foreach ($name as $k => $v) {
                    $this->_table->setOption($k, $v);
                }
            } else {
                return $this->_table->getOption($name);
            }
        } else {
            $this->_table->setOption($name, $value);
        }
    }

    /**
     * Binds One-to-One aggregate relation
     *
     * @param string $componentName     the name of the related component
     * @param string $options           relation options
     * @see Doctrine_Relation::_$definition
     */
    final protected function hasOne(): static
    {
        $this->_table->bind(func_get_args(), Doctrine_Relation::ONE);

        return $this;
    }

    /**
     * Binds One-to-Many / Many-to-Many aggregate relation
     *
     * @param string $componentName     the name of the related component
     * @param string $options           relation options
     * @see Doctrine_Relation::_$definition
     */
    final protected function hasMany(): static
    {
        $this->_table->bind(func_get_args(), Doctrine_Relation::MANY);

        return $this;
    }

    /**
     * Sets a column definition
     *
     * @param string $name
     * @param null|string $type
     * @param null|int $length
     * @param mixed $options
     */
    final protected function hasColumn(string $name, ?string $type = null, ?int $length = null, mixed $options = array()): void
    {
        $this->_table->setColumn($name, $type, $length, $options);
    }

    /**
     * Loads the given plugin.
     *
     * This method loads a behavior in the record. It will add the behavior
     * also to the record table if it.
     * It is tipically called in @see setUp().
     *
     * @param Doctrine_Template|class-string<Doctrine_Template> $tpl        if an object, must be a subclass of Doctrine_Template.
     *                          If a string, Doctrine will try to instantiate an object of the classes Doctrine_Template_$tpl and subsequently $tpl, using also autoloading capabilities if defined.
     * @param array $options    argument to pass to the template constructor if $tpl is a class name
     * @throws Doctrine_Record_Exception    if $tpl is neither an instance of Doctrine_Template subclass or a valid class name, that could be instantiated.
     */
    final protected function actAs(Doctrine_Template|string $tpl, array $options = array()): static
    {
        if ( ! is_object($tpl)) {
            $className = 'Doctrine_Template_' . $tpl;

            if (class_exists($className, true)) {
                $tpl = new $className($options);
            } else if (class_exists($tpl, true)) {
                $tpl = new $tpl($options);
            } else {
                throw new Doctrine_Record_Exception('Could not load behavior named: "' . $tpl . '"');
            }
        }

        if ( ! ($tpl instanceof Doctrine_Template)) {
            throw new Doctrine_Record_Exception('Loaded behavior class is not an instance of Doctrine_Template.');
        }

        $className = get_class($tpl);

        $this->_table->addTemplate($className, $tpl);

        $tpl->setInvoker($this);
        $tpl->setTable($this->_table);
        $tpl->setUp();
        $tpl->setTableDefinition();

        return $this;
    }

    /**
     * Adds a check constraint.
     *
     * This method will add a CHECK constraint to the record table.
     *
     * @param mixed $constraint     either a SQL constraint portion or an array of CHECK constraints. If array, all values will be added as constraint
     * @param null|string $name          optional constraint name. Not used if $constraint is an array.
     */
    final protected function check(mixed $constraint, ?string $name = null): static
    {
        if (is_array($constraint)) {
            foreach ($constraint as $name => $def) {
                $this->_table->addCheckConstraint($def, $name);
            }
        } else {
            $this->_table->addCheckConstraint($constraint, $name);
        }
        return $this;
    }
}
