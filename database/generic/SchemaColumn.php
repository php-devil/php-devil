<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;


class SchemaColumn
{
    protected $_size = null;
    protected $_params = null;

    public function __construct($type, $size = null, array $params = [])
    {

    }
}