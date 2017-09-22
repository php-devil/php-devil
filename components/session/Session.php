<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\components\session;
use PhpDevil\base\BaseComponent;
use PhpDevil\base\object\ObjectConfigureHelper;

class Session extends BaseComponent
{
    private $_storage = null;
    private $_name = 'default';

    public function setName($name)
    {
        $this->_name = $name;
        if (null !== $this->_storage) $this->_storage->setName($name);
    }

    public function setStorage($storage)
    {
        $this->_storage = ObjectConfigureHelper::instantiate($storage);
        if (null !== $this->_name)  $this->_storage->setName($this->_name);
    }
}