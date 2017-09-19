<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;
use PhpDevil\base\object\ObjectConfigureHelper;

/**
 * Базовый объект.
 * Реализует обработку свойств объекта, конфигурирование свойств из массива,
 * переданного конструктору, объявляет метод инициализации объекта после конфигурирования.
 *
 * @package PhpDevil\base
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class BaseObject
{
    /**
     * Инициализация объекта.
     * Вызывается из конструктора класса после применения конфигурационного массива.
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Конструктор объекта.
     * Выполняет конфигурирование объекта по переданному массиву и вызывает метод
     * инициализации объекта.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config)) {
            ObjectConfigureHelper::configure($this);
        }
    }
}