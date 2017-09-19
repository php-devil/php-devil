<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\object;
use PhpDevil\base\BaseException;

/**
 * Исключение возникает при попытке обращения к несуществующему свойству объекта
 *
 * @package PhpDevil\base\object
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class UnknownPropertyException extends BaseException
{
}