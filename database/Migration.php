<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database;
use PhpDevil\base\BaseObject;
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
        print_r(func_get_args());
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

    }
}