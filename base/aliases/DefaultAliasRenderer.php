<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\aliases;


class DefaultAliasRenderer
{
    public static function beforeRender($alias, array $options = [])
    {
        return $alias;
    }

    public static function afterRender($path)
    {
        return $path;
    }
}