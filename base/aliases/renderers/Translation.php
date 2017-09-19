<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\aliases\renderers;
use PhpDevil\base\aliases\DefaultAliasRenderer;

class Translation extends DefaultAliasRenderer
{
    public static function beforeRender($alias, array $options = [])
    {
        return str_replace('{...}', '/messages/' . $options['language'] . '/', $alias);
    }
}