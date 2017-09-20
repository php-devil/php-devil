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
    const MESS_DIR_NAME = '_messages';

    public static function beforeRender($alias, array $options = [])
    {
        return str_replace('{...}', '/' . self::MESS_DIR_NAME . '/' . $options['language'] . '/', $alias);
    }
}