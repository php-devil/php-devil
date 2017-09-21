<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\web;
use PhpDevil\base\BaseApplication;
use PhpDevil\components\session\Session;
use PhpDevil\components\user\User;

/**
 * Class Application
 *
 * @property Session $session
 * @property User $user
 *
 * @package PhpDevil\web
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class Application extends BaseApplication
{
    /**
     * Обязательная уонфигурация веб-приложения и параметры по умолчанию.
     * @return mixed
     */
    public static function configurationDefault()
    {
        return require __DIR__ . '/config/application.default.php';
    }
}