<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\base\BaseObject;
use PhpDevil\base\object\RequiredParamException;

/**
 * Class Table
 * Схема таблицы базы данных
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class Table extends BaseObject
{
    /**
     * @var DatabaseSchema
     */
    protected $_schema = null;
    protected $_tableName = null;

    protected $_tableExists = false;

    protected $_columns = null;
    protected $_primaryKey = null;
    protected $_keys = null;
    protected $_foreignKeys = null;

    protected $_tempColumns = [];

    /**
     * Проверка наличия таблицы в базе данных
     * @return bool
     */
    abstract protected function ensureTableExists();

    /**
     * Удаление таблицы
     * @param bool $softly
     * @return mixed
     */
    abstract public function dropTable(bool $softly = false);

    public function getColumnDefinition($name)
    {
        return (string) $this->_columns[$name];
    }

    final protected function afterDropTable()
    {
        $this->_tableExists = false;
        $this->_columns = null;
        $this->_keys = null;
        $this->_primaryKey = null;
        $this->_foreignKeys = null;
    }

    public function db()
    {
        return $this->_schema->db();
    }

    public function setSchema(DatabaseSchema $schema)
    {
        $this->_schema = $schema;
        return $this;
    }

    public function setTableName($name)
    {
        $this->_tableName = $name;
        return $this;
    }

    public function getExists()
    {
        return $this->_tableExists;
    }

    abstract public function getCreateTableQuery();

    public function init()
    {
        if (null === $this->_schema) throw new RequiredParamException([get_class($this), 'schema']);
        if (null === $this->_tableName) throw new RequiredParamException([get_class($this), 'tableName']);

        $this->_tableExists = $this->ensureTableExists();
    }
}