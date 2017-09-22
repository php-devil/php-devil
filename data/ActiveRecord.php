<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\data;

use PhpDevil\data\query\ActiveQuery;

class ActiveRecord extends Model
{
    public static function connectionComponentName()
    {
        return 'db';
    }

    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }
}