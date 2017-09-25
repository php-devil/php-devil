<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\console;
use PhpDevil\base\BaseApplication;
use PhpDevil\console\errors\ConsoleCallException;

/**
 * Class Application
 * Фронт-контроллер консольного приложения
 *
 * @package PhpDevil\console
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class Application extends BaseApplication
{
    protected $_sctiptName;

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
     * @throws ConsoleCallException
     */
    public function run(array $arguments = [])
    {
        try {
            if (!isset($arguments[1])) {
                throw new ConsoleCallException(['Не указан маршрут команды']);
            }

            $controller = null;
            $this->_sctiptName = array_shift($arguments);
            $route = $this->findRoute(array_shift($arguments));

            if ($module = $this->loadModule($route[0])) {
                $controller = $module->loadCommand($route[1]);
            }
            if (!$controller) {
                $controller = $this->loadCommand($route[0]);
            }

            if ($controller) {
                foreach ($arguments as $k=>$v) {
                    if (0 === strpos($v, '--') && false !== ($pos = strpos($v, '='))) {
                        $param = substr($v, 2, $pos - 2);
                        $controller->$param = (string) substr($v, $pos + 1);
                        unset($arguments[$k]);
                    }
                }
                return $controller->performCommand(array_values($arguments));
            } else {
                throw new ConsoleCallException(['Маршрут команды {route} не найден', 'route' => implode('/', $route)]);
            }

        } catch (ConsoleCallException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Дополнение маршрута
     * @param $route
     * @return array
     */
    protected function findRoute($route)
    {
        if (false === strpos($route, '/')) $route = [$route];
        else $route = explode('/', $route);
        if (!isset($route[1])) $route[1] = 'default';
        return $route;
    }

}