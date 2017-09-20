<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\object;
use PhpDevil\base\BaseException;

/**
 * Исключение возникает при попытки записи свойства только для чтения или
 * при попытке чтения свойства только для записи
 *
 * @package PhpDevil\base\object
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class BadCallException extends BaseException
{

}