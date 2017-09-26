<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\data\query;
use PhpDevil\components\db\Connection;
use PhpDevil\data\ActiveRecord;
use PhpDevil\database\query\QueryPlain;
use PhpDevil\Devil;

class ActiveQuery extends QueryPlain
{
    const COND_AND = 1;
    const COND_OR  = 2;

    /**
     * Имя класса основной модели для построения запроса
     * @var string|ActiveRecord
     */
    protected $_mainModelClass;

    /**
     * Критерии выборки
     * @var null|array
     */
    protected $_where = null;

    /**
     * Пределы выборки
     * @var null|array
     */
    protected $_limit = null;

    /**
     * Компонент соединения с базой данных
     * @return Connection
     */
    public function db()
    {
        return Devil::container()
            ->components
            ->get(($this->_mainModelClass)::connectionComponentName());
    }

    /**
     * Добавление условия выборки/обновления/удаления
     * @param array $condition
     * @return $this
     */
    public function where(array $condition = [])
    {
        if (!empty($condition)) {
            $this->_where = $condition;
        }
        return $this;
    }

    /**
     * Добавление условия запроса через логическое И
     * @param array $condition
     * @return $this
     */
    public function andWhere(array $condition = [])
    {
        if (!empty($condition)) {
            if (empty($this->_where)) $this->_where = $condition;
            else $this->_where = [self::COND_AND, $this->_where, $condition];
        }
        return $this;
    }

    /**
     * Добавление условия запроса через логическое ИЛИ
     * @param array $condition
     * @return $this
     */
    public function orWhere(array $condition = [])
    {
        if (!empty($condition)) {
            if (empty($this->_where)) $this->_where = $condition;
            else $this->_where = [self::COND_OR, $this->_where, $condition];
        }
        return $this;
    }

    /**
     * Установка пределов запроса
     * @param $limit
     * @param null $offset
     * @return $this
     */
    public function limit($limit, $offset = null)
    {
        $this->_limit = [$limit];
        if ($offset) {
            $this->_limit[] = $offset;
        }
        return $this;
    }

    /**
     * Подучение всех строк результата запроса в виде массива
     */
    public function all()
    {
        //@todo: implementation needed
        $query = $this->db()->prepareActiveQuery($this);
    }

    /**
     * ActiveQuery constructor.
     * @param string $modelClassName
     * @param array $config
     */
    public function __construct($modelClassName, array $config = [])
    {
        $this->_mainModelClass = $modelClassName;
        parent::__construct($config);
        $this->setConnection($this->db()->getPdo());
    }
}