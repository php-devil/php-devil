<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\mysql;

class SchemaColumn extends \PhpDevil\database\generic\SchemaColumn
{
    public function setType($type)
    {
        if ('integer' == $type) {
            $this->_type = 'int';
            if (null === $this->_size) $this->_size = 11;
        }
        if ('string' == $type) {
            $this->_type = 'varchar';
            if (null === $this->_size) $this->_size = 255;
        }
        if ('char' == $type) {
            if (null === $this->_size) $this->_size = 255;
        }
    }

    public function __toString()
    {
        $sql = $this->_type;
        if ($this->_size) $sql .= '(' . $this->_size . ')';
        if ($this->_unsigned) $sql .= ' unsigned';
        if ($this->_notNull)  $sql .= ' not null';
        if ($this->_default) {
            $sql .= ' default \'' . $this->_default . '\'';
        }
        if ($this->_autoIncrement) $sql .= ' auto_increment';
        return $sql;
    }
}