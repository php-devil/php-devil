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

    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    /**
     * @param null $condition
     * @return ActiveQuery
     */
    public static function findAll($condition = null)
    {
        return static::find()->where($condition);
    }
}