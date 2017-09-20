<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;
use PhpDevil\base\object\BadCallException;
use PhpDevil\base\object\ObjectConfigureHelper;
use PhpDevil\base\object\UnknownPropertyException;

/**
 * Базовый объект.
 * Реализует обработку свойств объекта, конфигурирование свойств из массива,
 * переданного конструктору, объявляет метод инициализации объекта после конфигурирования.
 *
 * @package PhpDevil\base
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class BaseObject implements Object
{
    /**
     * Возвращает конфигурацию объекта по умолчанию
     * @return array
     */
    public static function configurationDefault()
    {
        return [];
    }

    /**
     * Возвращает значение свойства объекта.
     *
     * @param $name
     * @return mixed
     * @throws BadCallException - если запрошенное свойство доступно только для записи
     * @throws UnknownPropertyException - если запрошенное свойство не определено
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new BadCallException(['Свойство {class}::{property} доступно только для записи',
                'class' => get_class($this),
                'property' => $name
            ]);
        } else {
            throw new UnknownPropertyException(['Свойство {class}::{property} не определено',
                'class' => get_class($this),
                'property' => $name
            ]);
        }
    }

    /**
     * Проверяет, доступно ли свойство для чтения.
     *
     * @param $name
     * @param bool $checkVars
     * @return bool
     */
    public function canGetProperty($name, $checkVars = false)
    {
        return method_exists($this, 'get' . $name)
            || $checkVars && property_exists($this, $name);
    }

    /**
     * Устанавливает значение свойства объекта.
     *
     * @param $name
     * @param $value
     * @throws BadCallException - если запрошенное свойство доступно только для записи
     * @throws UnknownPropertyException - если запрошенное свойство не определено
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new BadCallException(['Свойство {class}::{property} доступно только для чтения',
                'class' => get_class($this),
                'property' => $name
            ]);
        } else {
            throw new UnknownPropertyException(['Свойство {class}::{property} не определено',
                'class' => get_class($this),
                'property' => $name
            ]);
        }
    }

    /**
     * Проверяет, доступно ли свойство для записи.
     *
     * @param $name
     * @param bool $checkVars
     * @return bool
     */
    public function canSetProperty($name, $checkVars = false)
    {
        return method_exists($this, 'set' . $name)
            || $checkVars && property_exists($this, $name);
    }

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
            ObjectConfigureHelper::configure($this, array_merge(static::configurationDefault(), $config));
        }
        $this->init();
    }
}