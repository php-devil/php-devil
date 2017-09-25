<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\mysql;

/**
 * Class Database
 * Схема базы данных для mysql драйвера
 *
 * @package PhpDevil\database\mysql
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class Database extends \PhpDevil\database\generic\Database
{
    /**
     * Загрузка схемы таблицы при ее наличии или создание новой схемы
     * @param $name
     * @return Table
     */
    public function findTable($name)
    {
        if (!isset($this->_tables[$name])) {
            $this->_tables[$name] = new Table([
                'schema'    => $this,
                'tableName' => $name,
            ]);
        }
        return $this->_tables[$name];
    }
}