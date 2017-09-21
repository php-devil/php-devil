<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\data;
use PhpDevil\base\BaseComponent;
use PhpDevil\base\services\ModelsContainer;

abstract class BaseModel extends BaseComponent
{
    /**
     * Значения атрибутов модели
     * @var array
     */
    protected $_attributes = [];

    /**
     * Атрибуты модели определяются наличием из правил валидации.
     * Атрибуты, которые не должны проходить валидацию, должны быть перечислены с правилом валидации safe
     *
     * @return array
     */
    public static function rules()
    {
        return [];
    }

    /**
     * Метод для создания экземпляра класса модели.
     * В качестве параметра принимает массив значений атрибутов модели
     *
     * @param $attributes
     */
    public static function model($attributes)
    {

    }

    /**
     * Коноструктор модели.
     * Не должен вызываться напрямую.
     *
     * @param string $id
     * @param object $owner
     * @param array $config
     * @throws BaseModelException
     */
    public function __construct($id, $owner, array $config = [])
    {
        if (!($owner instanceof ModelsContainer)) throw new BaseModelException([
            'Для создания экземпляра класса модели используйте {class}::model(array $attributes = []);',
            'class' => get_class($this)
        ]);
        parent::__construct($id, $owner, $config);
    }
}