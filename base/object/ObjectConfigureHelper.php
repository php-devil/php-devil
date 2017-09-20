<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\object;
use PhpDevil\base\BaseObject;

/**
 * Class ObjectConfigureHelper
 * Конфигуратор объектов
 *
 * @package PhpDevil\base\object
 */
class ObjectConfigureHelper
{
    /**
     * Применение конфигурационного массива к переданному объекту
     *
     * @param BaseObject $object
     * @param array $properties
     *
     * @return BaseObject
     * @throws ConfigException
     */
    public static function configure(BaseObject $object, array $properties = [])
    {
        foreach ($properties as $name => $value) {
            $object->$name = $value;
        }
        return $object;
    }

    /**
     * Создание экземпляра класса по конфигурационному массиву.
     * Конструктор класса может принимать максимум 4 аргумента, последним из которых будет
     * конфигурационный массив.
     *
     * @param array $config
     * @param array $constructArgs
     * @return mixed
     * @throws ConfigException
     */
    public static function instantiate(array $config, array $constructArgs = [])
    {
        if (!isset($config['class'])) throw new ConfigException(['Не определен класс в конфигурационном массиве'], 1);
        if (!class_exists($config['class'])) throw new ConfigException(['Класс {class} не найлен', 'class' => $config['class']], 2);

        $className = $config['class'];
        unset($config['class']);
        $constructArgs[] = $config;

        switch (count($constructArgs)) {
            case '1': return new $className($constructArgs[0]);
            case '2': return new $className($constructArgs[0], $constructArgs[1]);
            case '3': return new $className($constructArgs[0], $constructArgs[1], $constructArgs[2]);
            case '4': return new $className($constructArgs[0], $constructArgs[1], $constructArgs[2], $constructArgs[3]);

            default:
                throw new ConfigException(['Определено некорректное количество аргументов конструктора класса {class}', 'class'=>$className], 3);
        }
    }
}