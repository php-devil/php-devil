<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\data\query\ActiveQuery;

/**
 * Class ActiveQueryParser
 * Парсер запросов ActiveQuery
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class ActiveQueryParser
{
    abstract public static function parse(ActiveQuery $query);
}