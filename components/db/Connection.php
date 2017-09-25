<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\components\db;
use PhpDevil\base\BaseComponent;
use PhpDevil\database\generic\DatabaseSchema;
use PhpDevil\database\query\QueryPlain;

/**
 * Class Connection
 *
 * @property DatabaseSchema $schema
 *
 * @package PhpDevil\components\db
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class Connection extends BaseComponent
{
    private $_dsn = null;
    private $_driverName = null;

    private $_user = '';
    private $_password = '';

    private $_pdo = null;

    /**
     * @var DatabaseSchema
     */
    private $_schema;

    /**
     * Схема базы данных
     * @return DatabaseSchema
     */
    public function getSchema()
    {
        return $this->_schema;
    }

    public function setDsn($dsn)
    {
        $this->_dsn = $dsn;
        $this->_driverName = substr($dsn, 0, strpos($dsn, ':'));
    }

    public function getPdo()
    {
        if (null === $this->_pdo) {
            $this->_pdo = new \PDO($this->_dsn, $this->_user, $this->_password);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->_pdo;
    }

    public function prepare($sql)
    {
        return new QueryPlain([
            'connection' => $this->getPdo(),
            'query' => $sql,
        ]);
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

    public function getTableSchemaClass()
    {
        return 'PhpDevil\database\\' . $this->getDriverName() . '\Schema';
    }

    public function init()
    {
        $schemaClassName = 'PhpDevil\database\\' . $this->getDriverName() . '\Database';
        $this->_schema = new $schemaClassName([
            'connection' => $this,
        ]);
    }
}