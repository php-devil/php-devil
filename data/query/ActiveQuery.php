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
    /**
     * Имя класса основной модели для построения запроса
     * @var string|ActiveRecord
     */
    protected $_mainModelClass;

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