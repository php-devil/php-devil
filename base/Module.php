<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;


interface Module
{
    /**
     * Возвращает имя пространства имен контроллеров
     * @return string
     */
    public function getControllersNamespace();
}