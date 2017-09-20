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
    }

    public function __construct(array $config = [])
    {
        Devil::ensureServices($this);
        parent::__construct($config);
    }

    public function __destruct()
    {
        echo ' --dd';
        Devil::clearServices();
    }
}