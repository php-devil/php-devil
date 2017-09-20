<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;

abstract class BaseController extends BaseComponent implements Controller
{
    public function __construct($id, array $config = [])
    {
        parent::__construct($config);
    }
}