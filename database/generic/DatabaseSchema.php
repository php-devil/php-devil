<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\components\db\Connection;

/**
 * Interface DatabaseSchema
 * Схема базы данных
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
interface DatabaseSchema
{
    /**
     * Компонент соединения с базой данных
     * @return Connection
     */
    public function db();

    /**
     * @param $name
     * @return TableSchema
     */
    public function findTable($name);
}