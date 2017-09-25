<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\components\db\Connection;

/**
 * Interface TableSchema
 * Схема таблицы
 *
 * @property bool $exists
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
interface TableSchema
{
    /**
     * Компонент соединения с базой данных
     * @return Connection
     */
    public function db();

    /**
     * Удаление таблицы
     * @param bool $softly
     * @return mixed
     */
    public function dropTable(bool $softly = false);
}