<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\data;

class ActiveRecord extends Model
{
    public static function connectionComponentName()
    {
        return 'db';
    }
}