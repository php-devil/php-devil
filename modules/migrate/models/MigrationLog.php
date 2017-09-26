<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\modules\migrate\models;
use PhpDevil\data\ActiveRecord;

class MigrationLog extends ActiveRecord
{
    public static function tableName()
    {
        return 'migrations';
    }
}