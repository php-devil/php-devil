<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\mysql;

use PhpDevil\database\generic\ColumnSchema;
use PhpDevil\database\MigrationColumn;

/**
 * Class Table
 * Схема таблицы базы данных
 *
 * @package PhpDevil\database\mysql
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class Table extends \PhpDevil\database\generic\Table
{
    /**
     * Проверка наличия таблицы в базе данных
     * @return bool
     */
    protected function ensureTableExists()
    {
        return !empty($this->db()->prepare("show tables like :table")->execute(['table' => $this->_tableName])->fetch());
    }

    /**
     * Добавление определения колонки во временные
     *
     * @param $name
     * @param MigrationColumn $column
     */
    public function addColumnDefinition($name, MigrationColumn $column)
    {
        $this->_columns[$name] = new SchemaColumn($column);
        if ($key = $column->isKey()) {
            if (ColumnSchema::KEY_PRIMARY == $column->isKey()) {
                if (null === $this->_primaryKey) {
                    $this->_primaryKey = [];
                }
                $this->_primaryKey[] = $name;
            }
        }
    }

    public function getCreateTableQuery($tableOptions = '')
    {
        $sql = 'create table `' . $this->_tableName. '` (';
        $delimiter = "\n\t";
        foreach ($this->_columns as $k=>$col) {
            $sql .= $delimiter . '`' . $k . '` ' . $col;
            $delimiter = ",\n\t";
        }
        if ($this->_primaryKey) {
            $sql .= $delimiter . 'primary key (`' . implode('`, `', $this->_primaryKey) . '`)';
            $delimiter = ",\n\t";
        }
        if (!empty($this->_keys)) foreach ($this->_keys as $name=>$param) {
            $sql .= $delimiter;
            if (ColumnSchema::KEY_INDEX === $param[0]) $sql .= 'key `' . $name . '` ';
            if (ColumnSchema::KEY_UNIQUE === $param[0]) $sql .= 'unique key `' . $name . '` ';
            $sql .= '(`' . $param[1] . '`)';
        }
        $sql .= ')';
        if (!empty($this->_tableOptions)) $sql .= ', ' . $this->_tableOptions;
        return $sql;
    }

    /**
     * Удаление таблицы
     * @param bool $softly
     * @return mixed
     */
    public function dropTable(bool $softly = false)
    {
        if ($softly) $softly = " if exists";
        $this->db()->prepare("drop table{$softly} `{$this->_tableName}`")->execute();
        $this->afterDropTable();
    }

    public function createTable($tableOptions = '')
    {
        $this->db()->prepare($this->getCreateTableQuery($tableOptions))->execute();
        $this->_tableExists = true;
        $this->_columns = null;
        $this->_keys = null;
        $this->_primaryKey = null;
    }
}