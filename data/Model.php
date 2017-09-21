<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\data;

/**
 * Реализует работу с атрибутами моделей.
 * При запросе при помощи __get и __set при наличии атрибута с соответствующим именем будет прочитано
 * или установлено значение атрибута, значение свойства будет проигнорировано.
 *
 * @package PhpDevil\data
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class Model extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function rules()
    {
        return [];
    }

    /**
     * Атрибуты модели определяются наличием из правил валидации rules().
     * Атрибуты, которые не должны проходить валидацию, должны быть перечислены с правилом валидации safe.
     * К не перечисленные в правилах валидации атрибутам будет применяться логика обработки свойств объекта.
     *
     * @return array
     */
    protected function ensureAttributes()
    {
        $rules = static::rules();
        foreach ($rules as $rule) {
            foreach ($rule[0] as $attrName) $this->_attributes[$attrName] = null;

        }
    }
}