<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database\generic;
use PhpDevil\base\BaseObject;
use PhpDevil\database\ColumnTypeException;

class Schema extends BaseObject
{
    public $types = [];
    public $columnClass = SchemaColumn::class;

    /**
     * @param $name
     * @param $arguments
     * @return SchemaColumn
     * @throws ColumnTypeException
     */
    public function createColumn($name, $arguments)
    {
        $columnClass = $this->columnClass;
        if (isset($this->types[$name])) {
            $size = null;
            if (!empty($arguments)) $size = array_shift($arguments);
            return new $columnClass($this->types[$name], $size, $arguments);
        } else {
            throw new ColumnTypeException(['Неизвестный тип поля {type}', ['type' => $name]]);
        }
    }
}