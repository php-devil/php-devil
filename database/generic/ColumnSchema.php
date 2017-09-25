<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;

/**
 * Interface ColumnSchema
 * Поле таблицы базы данных
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
interface ColumnSchema
{
    /**
     * Типы ключей
     */
    const KEY_PRIMARY = 1;  // первичный
    const KEY_INDEX = 2;    // индекс
    const KEY_UNIQUE = 3;   // уникальный

}