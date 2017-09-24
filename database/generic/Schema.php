<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\base\BaseObject;
use PhpDevil\database\ColumnTypeException;

/**
 * Class Schema
 * Посторение схемы таблицы по миграциям
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class Schema extends BaseObject
{
    protected $_tableName = [];

    protected $_columns = [];

    protected $_tableOptions = [];

    abstract public static function getColumnClass();

    public static function setDefaults($column)
    {
        return $column;
    }

    public static function createColumn($config)
    {
        $class = static::getColumnClass();
        return new $class($config);
    }

    public function setTableName($name)
    {
        $this->_tableName = $name;
    }

    public function setTableOptions($options)
    {
        $this->_tableOptions = $options;
    }

    public function getColumnDefinition($name)
    {
        return (string) $this->_columns[$name];
    }

    public function setColumns(array $columns)
    {
        foreach ($columns as $k=>$v) {

            $this->_columns[$k] = static::setDefaults($v);
        }
    }
}