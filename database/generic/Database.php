<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\base\BaseObject;
use PhpDevil\components\db\Connection;

/**
 * Class Database
 * Схема базы данных
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class Database extends BaseObject implements DatabaseSchema
{
    /**
     * Компонент для подключения к базе данных
     * @var Connection
     */
    protected $_connection;

    /**
     * Загруженные таблицы базы данных
     * @var array
     */
    protected $_tables = [];

    /**
     * Имя класса схемы таблицы
     * @var string
     */
    protected $_tableSchemaClass = Table::class;

    /**
     * Загрузка определения таблицы при ее наличии в БД
     * @param $name
     * @return mixed
     */
    abstract public function findTable($name);

    /**
     * @return Connection
     */
    public function db()
    {
        return $this->_connection;
    }

    /**
     * Компонент подключения к базе данных
     * @param Connection $connection
     * @return $this
     */
    public function setConnection(Connection $connection)
    {
        $this->_connection = $connection;
        return $this;
    }


}