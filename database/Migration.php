<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database;
use PhpDevil\base\BaseObject;
use PhpDevil\database\generic\Schema;
use PhpDevil\Devil;

/**
 * Class Migration.
 * Миграция реализует изменение структуры базы данных
 *
 * @package PhpDevil\database
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class Migration extends BaseObject
{
    protected $_connection = null;

    protected $_schemas = null;



    /**
     * Применение миграции
     * @return mixed
     */
    abstract public function up();

    /**
     * Откат миграции
     * @return mixed
     */
    abstract public function down();

    public $connectionName = 'db';

    /**
     * Возвращает компонент соединения с БД, через который будет выполнена миграция
     * @return \PhpDevil\components\db\Connection
     */
    public function db()
    {
        return Devil::container()->components->get($this->connectionName);
    }

    /**
     * Метод для вызова createColumn
     *
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        $schema = $this->db()->getTableSchemaClass();
        $size = $arguments[0] ?? null;
        unset($arguments[0]);
        return $schema::createColumn([
            'type' => $name,
            'size' => $size,
            'params' => $arguments
        ]);
    }

    public function integerPrimaryKey()
    {
        return $this->integer(11)
            ->notNull()
            ->unsigned()
            ->autoIncrement()
            ->primary();
    }

    /**
     * Создает в БД таблицу по заданной конфигурации
     *
     * @param string $tableName   - имя таблицы
     * @param array  $definitions - определения колонок
     * @param string $options     - параметры таблицы
     *
     */
    protected function createTable($tableName, array $definitions, $options = '')
    {
        $schema = $this->createSchema($tableName, $definitions, $options);
        $sql = $schema->getCreateTableQuery();

        echo "\n\nQUERY:\n\n" . $sql;
    }

    protected function createSchema($tableName, $definitions, $options = '')
    {
        $schema = $this->db()->getTableSchemaClass();
        return new $schema([
            'tableName' => $tableName,
            'columns'   => $definitions,
            'tableOptions' => $options
        ]);
    }
}