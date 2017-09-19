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
     * @return BaseObject
     */
    public static function configure(BaseObject $object, array $properties = [])
    {
        foreach ($properties as $name => $value) {
            $object->$name = $value;
        }
        return $object;
    }

}