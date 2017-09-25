<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database;
use PhpDevil\base\BaseObject;

class MigrationColumn extends BaseObject
{
    const K_PRIMARY = 1;
    const K_INDEX = 2;
    const K_UNIQUE = 3;

    protected $_type = null;

    protected $_size = null;

    protected $_params = null;

    protected $_notNull = false;

    protected $_unsigned = false;

    protected $_default = null;

    protected $_keyName = null;

    protected $_keyType = null;

    protected $_autoIncrement = false;

    public function setType($type)
    {
        $this->_type = $type;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function setSize($size)
    {
        $this->_size = $size;
    }

    public function getSize()
    {
        return $this->_size;
    }

    public function setParams($params)
    {
        $this->_params = $params;
    }

    public function getParams()
    {
        return $this->_params;
    }

    public function notNull()
    {
        $this->_notNull = true;
        return $this;
    }

    public function autoIncrement()
    {
        $this->_autoIncrement = true;
        return $this;
    }

    public function unsigned()
    {
        $this->_unsigned = true;
        return $this;
    }

    public function primary()
    {
        $this->_keyType = self::K_PRIMARY;
        return $this;
    }

    public function index()
    {
        $this->_keyType = self::K_INDEX;
        return $this;
    }

    public function unique()
    {
        $this->_keyType = self::K_UNIQUE;
        return $this;
    }

    public function defaultValue($value)
    {
        $this->_default = $value;
        return $this;
    }

    public function isKey()
    {
        return $this->_keyType;
    }

    public function getConfig()
    {
        return [
            'type' => $this->_type,
            'size' => $this->_size,
            'notNull' => $this->_notNull,
            'unsigned' => $this->_unsigned,
            'autoIncrement' => $this->_autoIncrement,
            'default' => $this->_default,
            'keyType' => $this->_keyType,
        ];
    }
}