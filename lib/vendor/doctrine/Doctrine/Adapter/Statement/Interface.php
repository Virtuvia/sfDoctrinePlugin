<?php
/*
 *  $Id: Interface.php 7490 2010-03-29 19:53:27Z jwage $
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
 * Interface for Doctrine adapter statements
 *
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @package     Doctrine
 * @subpackage  Adapter
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision: 7490 $
 */
interface Doctrine_Adapter_Statement_Interface
{
    /**
     * Bind a column to a PHP variable
     *
     * @param mixed $column         Number of the column (1-indexed) or name of the column in the result set.
     *                              If using the column name, be aware that the name should match
     *                              the case of the column, as returned by the driver.
     * @param string $param         Name of the PHP variable to which the column will be bound.
     * @param int $type         Data type of the parameter, specified by the Doctrine_Core::PARAM_* constants.
     * @return bool              Returns TRUE on success or FALSE on failure
     */
    public function bindColumn($column, $param, $type = null);

    /**
     * Binds a value to a corresponding named or question mark
     * placeholder in the SQL statement that was use to prepare the statement.
     *
     * @param mixed $param          Parameter identifier. For a prepared statement using named placeholders,
     *                              this will be a parameter name of the form :name. For a prepared statement
     *                              using question mark placeholders, this will be the 1-indexed position of the parameter
     *
     * @param mixed $value          The value to bind to the parameter.
     * @param int $type         Explicit data type for the parameter using the Doctrine_Core::PARAM_* constants.
     *
     * @return bool              Returns TRUE on success or FALSE on failure.
     */
    public function bindValue($param, $value, $type = null);

    /**
     * Binds a PHP variable to a corresponding named or question mark placeholder in the
     * SQL statement that was use to prepare the statement. Unlike Doctrine_Adapter_Statement_Interface->bindValue(),
     * the variable is bound as a reference and will only be evaluated at the time
     * that Doctrine_Adapter_Statement_Interface->execute() is called.
     *
     * Most parameters are input parameters, that is, parameters that are
     * used in a read-only fashion to build up the query. Some drivers support the invocation
     * of stored procedures that return data as output parameters, and some also as input/output
     * parameters that both send in data and are updated to receive it.
     *
     * @param mixed $param          Parameter identifier. For a prepared statement using named placeholders,
     *                              this will be a parameter name of the form :name. For a prepared statement
     *                              using question mark placeholders, this will be the 1-indexed position of the parameter
     *
     * @param mixed $variable       Name of the PHP variable to bind to the SQL statement parameter.
     *
     * @param int $type         Explicit data type for the parameter using the Doctrine_Core::PARAM_* constants. To return
     *                              an INOUT parameter from a stored procedure, use the bitwise OR operator to set the
     *                              Doctrine_Core::PARAM_INPUT_OUTPUT bits for the data_type parameter.
     *
     * @param int $length       Length of the data type. To indicate that a parameter is an OUT parameter
     *                              from a stored procedure, you must explicitly set the length.
     * @param mixed $driverOptions
     * @return bool              Returns TRUE on success or FALSE on failure.
     */
    public function bindParam($column, &$variable, $type = null, $length = null, $driverOptions = []);

    /**
     * Closes the cursor, enabling the statement to be executed again.
     *
     * @return bool              Returns TRUE on success or FALSE on failure.
     */
    public function closeCursor();

    /**
     * Returns the number of columns in the result set
     *
     * @return int              Returns the number of columns in the result set represented
     *                              by the Doctrine_Adapter_Statement_Interface object. If there is no result set,
     *                              this method should return 0.
     */
    public function columnCount();

    /**
     * Fetch the SQLSTATE associated with the last operation on the statement handle
     *
     * @see Doctrine_Adapter_Interface::errorCode()
     * @return string       error code string
     */
    public function errorCode();

    /**
     * Fetch extended error information associated with the last operation on the statement handle
     *
     * @see Doctrine_Adapter_Interface::errorInfo()
     * @return array        error info array
     */
    public function errorInfo();

    /**
     * Executes a prepared statement
     *
     * If the prepared statement included parameter markers, you must either:
     * call PDOStatement->bindParam() to bind PHP variables to the parameter markers:
     * bound variables pass their value as input and receive the output value,
     * if any, of their associated parameter markers or pass an array of input-only
     * parameter values
     *
     *
     * @param array $params             An array of values with as many elements as there are
     *                                  bound parameters in the SQL statement being executed.
     * @return bool                  Returns TRUE on success or FALSE on failure.
     */
    public function execute($params = null);

    /**
     * fetch
     *
     * @see Doctrine_Core::FETCH_* constants
     * @param int $fetchStyle           Controls how the next row will be returned to the caller.
     *                                      This value must be one of the Doctrine_Core::FETCH_* constants,
     *                                      defaulting to Doctrine_Core::FETCH_BOTH
     *
     * @param int $cursorOrientation    For a PDOStatement object representing a scrollable cursor,
     *                                      this value determines which row will be returned to the caller.
     *                                      This value must be one of the Doctrine_Core::FETCH_ORI_* constants, defaulting to
     *                                      Doctrine_Core::FETCH_ORI_NEXT. To request a scrollable cursor for your
     *                                      Doctrine_Adapter_Statement_Interface object,
     *                                      you must set the Doctrine_Core::ATTR_CURSOR attribute to Doctrine_Core::CURSOR_SCROLL when you
     *                                      prepare the SQL statement with Doctrine_Adapter_Interface->prepare().
     *
     * @param int $cursorOffset         For a Doctrine_Adapter_Statement_Interface object representing a scrollable cursor for which the
     *                                      $cursorOrientation parameter is set to Doctrine_Core::FETCH_ORI_ABS, this value specifies
     *                                      the absolute number of the row in the result set that shall be fetched.
     *
     *                                      For a Doctrine_Adapter_Statement_Interface object representing a scrollable cursor for
     *                                      which the $cursorOrientation parameter is set to Doctrine_Core::FETCH_ORI_REL, this value
     *                                      specifies the row to fetch relative to the cursor position before
     *                                      Doctrine_Adapter_Statement_Interface->fetch() was called.
     *
     * @return mixed
     */
    public function fetch($fetchStyle = Doctrine_Core::FETCH_BOTH,
        $cursorOrientation = Doctrine_Core::FETCH_ORI_NEXT,
        $cursorOffset = null);

    /**
     * Returns an array containing all of the result set rows
     *
     * @param int $fetchStyle           Controls how the next row will be returned to the caller.
     *                                      This value must be one of the Doctrine_Core::FETCH_* constants,
     *                                      defaulting to Doctrine_Core::FETCH_BOTH
     *
     * @param int $columnIndex          Returns the indicated 0-indexed column when the value of $fetchStyle is
     *                                      Doctrine_Core::FETCH_COLUMN. Defaults to 0.
     *
     * @return array
     */
    public function fetchAll($fetchStyle = Doctrine_Core::FETCH_BOTH);

    /**
     * Returns a single column from the next row of a
     * result set or FALSE if there are no more rows.
     *
     * @param int $columnIndex          0-indexed number of the column you wish to retrieve from the row. If no
     *                                      value is supplied, Doctrine_Adapter_Statement_Interface->fetchColumn()
     *                                      fetches the first column.
     *
     * @return string                       returns a single column in the next row of a result set.
     */
    public function fetchColumn($columnIndex = 0);

    /**
     * Fetches the next row and returns it as an object.
     *
     * Fetches the next row and returns it as an object. This function is an alternative to
     * Doctrine_Adapter_Statement_Interface->fetch() with Doctrine_Core::FETCH_CLASS or Doctrine_Core::FETCH_OBJ style.
     *
     * @param string $className             Name of the created class, defaults to stdClass.
     * @param array $args                   Elements of this array are passed to the constructor.
     *
     * @return mixed                        an instance of the required class with property names that correspond
     *                                      to the column names or FALSE in case of an error.
     */
    public function fetchObject($className = 'stdClass', $args = []);

    /**
     * Retrieve a statement attribute
     *
     * @param int $attribute
     * @see Doctrine_Core::ATTR_* constants
     * @return mixed                        the attribute value
     */
    public function getAttribute($attribute);

    /**
     * Returns metadata for a column in a result set
     *
     * @param int $column               The 0-indexed column in the result set.
     *
     * @return array                        Associative meta data array with the following structure:
     *
     *          native_type                 The PHP native type used to represent the column value.
     *          driver:decl_                type The SQL type used to represent the column value in the database. If the column in the result set is the result of a function, this value is not returned by PDOStatement->getColumnMeta().
     *          flags                       Any flags set for this column.
     *          name                        The name of this column as returned by the database.
     *          len                         The length of this column. Normally -1 for types other than floating point decimals.
     *          precision                   The numeric precision of this column. Normally 0 for types other than floating point decimals.
     *          pdo_type                    The type of this column as represented by the PDO::PARAM_* constants.
     */
    public function getColumnMeta($column);

    /**
     * Advances to the next rowset in a multi-rowset statement handle
     *
     * Some database servers support stored procedures that return more than one rowset
     * (also known as a result set). The nextRowset() method enables you to access the second
     * and subsequent rowsets associated with a PDOStatement object. Each rowset can have a
     * different set of columns from the preceding rowset.
     *
     * @return bool                      Returns TRUE on success or FALSE on failure.
     */
    public function nextRowset();

    /**
     * rowCount() returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement
     * executed by the corresponding object.
     *
     * If the last SQL statement executed by the associated Statement object was a SELECT statement,
     * some databases may return the number of rows returned by that statement. However,
     * this behaviour is not guaranteed for all databases and should not be
     * relied on for portable applications.
     *
     * @return int                      Returns the number of rows.
     */
    public function rowCount();

    /**
     * Set a statement attribute
     *
     * @param int $attribute
     * @param mixed $value                  the value of given attribute
     * @return bool                      Returns TRUE on success or FALSE on failure.
     */
    public function setAttribute($attribute, $value);

    /**
     * Set the default fetch mode for this statement
     *
     * @param int $mode                 The fetch mode must be one of the Doctrine_Core::FETCH_* constants.
     * @return bool                      Returns 1 on success or FALSE on failure.
     */
    public function setFetchMode($mode, $arg1 = null, $arg2 = null);
}
