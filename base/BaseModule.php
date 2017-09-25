<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;
use PhpDevil\base\scalar\StringHelper;

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

    protected $_commands = [];

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
     * Предустановка конфигураций контроллеров
     * @param array $controllers
     */
    public function setCommands(array $controllers=[])
    {
        foreach ($controllers as $id=>$config) {
            $this->_commands[$id]=$config;
        }
    }

    /**
     * Возвращает имя пространства имен контроллеров
     * @return string
     */
    public function getCommandsNamespace()
    {
        return dirname(get_class($this)) . '\\commands';
    }

    public function loadCommand($id)
    {
        if (isset($this->_commands[$id])) {
            $className = $this->_commands[$id];
        } else {
            $className = $this->getCommandsNamespace() . '\\' . StringHelper::convertI2N($id) . 'Command';
        }

        if (class_exists($className)) {
            return new $className($id, $this, []);
        } else {
            return null;
        }
    }
}