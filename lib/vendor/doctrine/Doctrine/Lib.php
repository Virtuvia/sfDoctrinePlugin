<?php
/*
 *  $Id: Lib.php 7490 2010-03-29 19:53:27Z jwage $
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
 * Doctrine_Lib has not commonly used static functions, mostly for debugging purposes
 *
 * @package     Doctrine
 * @subpackage  Lib
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision: 7490 $
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 */
final class Doctrine_Lib
{
    // Code from symfony sfToolkit class. See LICENSE
    // code from php at moechofe dot com (array_merge comment on php.net)
    /*
     * arrayDeepMerge
     *
     * array arrayDeepMerge ( array array1 [, array array2 [, array ...]] )
     *
     * Like array_merge
     *
     *  arrayDeepMerge() merges the elements of one or more arrays together so
     * that the values of one are appended to the end of the previous one. It
     * returns the resulting array.
     *  If the input arrays have the same string keys, then the later value for
     * that key will overwrite the previous one. If, however, the arrays contain
     * numeric keys, the later value will not overwrite the original value, but
     * will be appended.
     *  If only one array is given and the array is numerically indexed, the keys
     * get reindexed in a continuous way.
     *
     * Different from array_merge
     *  If string keys have arrays for values, these arrays will merge recursively.
     */
    public static function arrayDeepMerge()
    {
        switch (func_num_args()) {
            case 0:
                return false;
            case 1:
                return func_get_arg(0);
            case 2:
                $args = func_get_args();
                $args[2] = [];

                if (is_array($args[0]) && is_array($args[1])) {
                    foreach (array_unique(array_merge(array_keys($args[0]), array_keys($args[1]))) as $key) {
                        $isKey0 = array_key_exists($key, $args[0]);
                        $isKey1 = array_key_exists($key, $args[1]);

                        if ($isKey0 && $isKey1 && is_array($args[0][$key]) && is_array($args[1][$key])) {
                            $args[2][$key] = self::arrayDeepMerge($args[0][$key], $args[1][$key]);
                        } elseif ($isKey0 && $isKey1) {
                            $args[2][$key] = $args[1][$key];
                        } elseif (! $isKey1) {
                            $args[2][$key] = $args[0][$key];
                        } elseif (! $isKey0) {
                            $args[2][$key] = $args[1][$key];
                        }
                    }

                    return $args[2];
                } else {
                    return $args[1];
                }
                // no break
            default:
                $args = func_get_args();
                $args[1] = self::arrayDeepMerge($args[0], $args[1]);
                array_shift($args);

                return call_user_func_array(['Doctrine_Lib', 'arrayDeepMerge'], $args);
                break;
        }
    }

    /**
     * Makes the directories for a path recursively.
     *
     * This method creates a given path issuing mkdir commands for all folders
     * that do not exist yet. Equivalent to 'mkdir -p'.
     *
     * @param string $path
     * @param int $mode     an integer (octal) chmod parameter for the
     *                          created directories
     * @return bool  true if succeeded
     */
    public static function makeDirectories($path, $mode = 0777)
    {
        if (! $path) {
            return false;
        }

        if (is_dir($path) || is_file($path)) {
            return true;
        }

        return mkdir(trim($path), $mode, true);
    }

    /**
     * Removes a non empty directory.
     *
     * This method recursively removes a directory and all its descendants.
     * Equivalent to 'rm -rf'.
     *
     * @param string $folderPath
     * @return bool  success of the operation
     */
    public static function removeDirectories($folderPath)
    {
        if (is_dir($folderPath)) {
            foreach (scandir($folderPath) as $value) {
                if ($value != '.' && $value != '..') {
                    $value = $folderPath . "/" . $value;

                    if (is_dir($value)) {
                        self::removeDirectories($value);
                    } elseif (is_file($value)) {
                        unlink($value);
                    }
                }
            }

            return rmdir($folderPath);
        } else {
            return false;
        }
    }

    /**
     * Copy all directory content in another one.
     *
     * This method recursively copies all $source files and subdirs in $dest.
     * If $source is a file, only it will be copied in $dest.
     *
     * @param string $source    a directory path
     * @param string $dest      a directory path
     * @return
     */
    public static function copyDirectory($source, $dest)
    {
        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (! is_dir($dest)) {
            mkdir($dest);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            if ($dest !== "$source/$entry") {
                self::copyDirectory("$source/$entry", "$dest/$entry");
            }
        }

        // Clean up
        $dir->close();

        return true;
    }

    /**
     * Converts a Doctrine Type to a PHP Type
     *
     * This method was built to be used for phpDoc generation
     *
     * @param string $doctrineType
     * @return string
     */
    public static function convertDoctrineTypeToPhpType(string $doctrineType): string
    {
        // based on logic in \Doctrine_Table::prepareValue
        switch ($doctrineType) {
            case 'bool':
            case 'boolean':
                return 'bool';
            case 'object':
            case 'array':
                return 'mixed';
            case 'set':
                return 'array';
        }

        // most values from the database are strings in PHP
        return 'string';
    }
}
