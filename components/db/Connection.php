<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\components\db;
use PhpDevil\base\BaseComponent;

class Connection extends BaseComponent
{
    private $_dsn = null;
    private $_driverName = null;

    private $_user = '';
    private $_password = '';

    public function setDsn($dsn)
    {
        $this->_dsn = $dsn;
        $this->_driverName = substr($dsn, 0, strpos($dsn, ':'));
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getDriverName()
    {
        return $this->_driverName;
    }

    public function getTableSchema()
    {
        $className = 'PhpDevil\database\\' . $this->getDriverName() . '\Schema';
        return new $className();
    }

    public function init()
    {
    }
}