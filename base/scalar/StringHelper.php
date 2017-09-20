<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\scalar;


class StringHelper
{
    /**
     * Подстановка в строковый шаблон $template на места плейсхолдеров {name}
     * значений массива $arguments с соответствующими именами.
     *
     * ```php
     * $template = '{day} день {week} недели';
     * $result = StringHelper::render($template, ['day'=>'Первый', 'week'=>'Нечетной']);
     * echo $result;
     * // выведет Первый день Нечетной недели
     * ```
     *
     * @param $template
     * @param array $arguments
     *
     * @return string
     */
    public static function render($template, array $arguments = [])
    {
        if (!empty($arguments)) {
            $replace = [];
            foreach ($arguments as $name=>$value) $replace['{' . $name . '}'] = $value;
            return strtr($template, $replace);
        } else {
            return $template;
        }
    }

    /**
     * Конвертирует регистронезависимый идентификатор в часть имени класса или метода
     *
     * @param $identifier
     * @return mixed
     */
    public static function convertI2N($identifier)
    {
        return $identifier;
    }
}