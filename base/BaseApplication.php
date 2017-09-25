<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;


use PhpDevil\Devil;

abstract class BaseApplication extends BaseModule
{

    public function __get($name)
    {
        if (Devil::container()->components->has($name)) {
            return Devil::container()->components->get($name);
        } else {
            return parent::__get($name);
        }
    }

    /**
     * Конфигурирование фронт-контроллеров модулей
     * @param array $modules
     */
    public function setModules(array $modules=[])
    {
    }

    /**
     * Конфигурирование компонентов
     * @param array $components
     */
    public function setComponents(array $components=[])
    {
        foreach ($components as $id => $config) {
            if (is_string($config) && class_exists($config)) $config = ['class' => $config];
            Devil::container()->components->register($id, $config);
        }
    }

    public function __construct(array $config = [])
    {
        Devil::clearServices();
        Devil::ensureServices($this);
        parent::__construct('app', Devil::container(), $config);
    }

    public function __destruct()
    {
        Devil::clearServices();
    }
}