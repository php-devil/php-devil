<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\base\BaseObject;
use PhpDevil\database\MigrationColumn;

/**
 * Class SchemaColumn
 * Построение SQL выражения для определения поля таблицы
 *
 * @package PhpDevil\database\generic
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class SchemaColumn extends BaseObject
{
    protected $_type = null;
    protected $_size = null;
    protected $_notNull = false;
    protected $_unsigned = false;
    protected $_default = null;
    protected $_autoIncrement = false;
    protected $_keyType = null;

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    public function setSize($size)
    {
        if ($size) $this->_size = $size;
        return $this;
    }

    public function setNotNull($notNull)
    {
        $this->_notNull = $notNull;
        return $this;
    }

    public function setUnsigned($unsigned)
    {
        $this->_unsigned = $unsigned;
        return $this;
    }

    public function setDefault($default)
    {
        $this->_default = $default;
        return $this;
    }

    public function setAutoIncrement($ai)
    {
        $this->_autoIncrement = $ai;
        return $this;
    }

    public function setKeyType($key)
    {
        $this->_keyType = $key;
        return $this;
    }

    final public function __construct(MigrationColumn $column)
    {
        parent::__construct($column->getConfig());
    }
}