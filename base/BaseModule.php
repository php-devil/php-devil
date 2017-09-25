<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;

/**
 * Реализация базового функционала фронт-контроллера модуля приложения:
 * - предустановка конфигураций контроллеров
 *
 * @package PhpDevil\base
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class BaseModule extends BaseComponent implements Module
{
    /**
     * Предустановленные конфигурации контроллеров
     * @var
     */
    protected $_controllers = [];

    /**
     * Предустановка конфигураций контроллеров
     * @param array $controllers
     */
    public function setControllers(array $controllers=[])
    {
        foreach ($controllers as $id=>$config) {
            $this->_controllers[$id]=$config;
        }
    }

    /**
     * Возвращает имя пространства имен контроллеров
     * @param $suffix
     * @return string
     */
    public function getControllersNamespace($suffix = null)
    {
        $namespace = dirname(get_class($this)) . '\\controllers';
        if ($suffix) $namespace .= '\\' . $suffix;
        return $namespace;
    }

    /**
     * Возвращает имя пространства имен контроллеров
     * @return string
     */
    public function getCommandsNamespace()
    {
        return dirname(get_class($this)) . '\\commands';
    }
}