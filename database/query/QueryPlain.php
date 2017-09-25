<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\query;
use PhpDevil\base\BaseObject;

class QueryPlain extends BaseObject
{
    /**
     * @var \PDO
     */
    protected $_handler = null;

    /**
     * @var string
     */
    protected $_query = null;

    /**
     * @var array
     */
    protected $_arguments = null;

    /**
     * @var \PDOStatement
     */
    protected $_stmt = null;

    /**
     * PDO, через который будет выполняться запрос
     * @param \PDO $handler
     * @return $this
     */
    public function setConnection(\PDO $handler)
    {
        $this->_handler = $handler;
        return $this;
    }

    /**
     * Установка текста запроса
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->_query = $query;
        return $this;
    }

    /**
     * Аргументы запроса (должны соответствовать плейсхолдерам)
     * @param $arguments
     * @return $this
     */
    public function setArguments($arguments)
    {
        $this->_arguments = $arguments;
        return $this;
    }

    public function fetch($mode = \PDO::FETCH_ASSOC)
    {
        return $this->_stmt->fetch($mode);
    }

    public function fetchAll($mode = \PDO::FETCH_ASSOC)
    {
        return $this->_stmt->fetchAll($mode);
    }

    public function execute($arguments = null)
    {
        if (null !== $arguments) $this->setArguments($arguments);
        $this->_stmt = $this->_handler->prepare($this->_query);
        $this->_stmt->execute($this->_arguments);
        return $this;
    }
}