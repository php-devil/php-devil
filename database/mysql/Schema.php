<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\mysql;

class Schema extends \PhpDevil\database\generic\Schema
{
    public $columnClass = SchemaColumn::class;

    public $types = [
        'integer'     => 'int',
        'string'      => 'varchar',
        'charString'  => 'char',
    ];
}