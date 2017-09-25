<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\console;
use PhpDevil\base\BaseApplication;

/**
 * Class Application
 * Фронт-контроллер консольного приложения
 *
 * @package PhpDevil\console
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

    /**
     * Выполнение приложения
     * @param array $arguments
     */
    public function run(array $arguments = [])
    {

    }
}