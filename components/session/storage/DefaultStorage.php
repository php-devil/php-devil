<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\components\session\storage;
use PhpDevil\components\session\SessionStorage;

/**
 * Class DefaultStorage
 * Сессия хранится и обрабатывается в $_SESSION
 *
 * @package PhpDevil\components\session\storage
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class DefaultStorage implements SessionStorage
{
    public function setName($name)
    {

    }
}