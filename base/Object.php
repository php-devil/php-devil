<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;

/**
 * Interface Object
 *
 * Кроме объявленных интерфейсом методов конструктор базового объекта и всех
 * производных классов должен принимать последним арументом конфигураационный массив
 * и вызывать родительский конструктор.
 *
 * @package PhpDevil\base
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
interface Object
{
    /**
     * Проверяет, доступно ли свойство для чтения.
     *
     * @param $name
     * @param bool $checkVars
     * @return bool
     */
    public function canGetProperty($name, $checkVars = false);

    /**
     * Проверяет, доступно ли свойство для записи.
     *
     * @param $name
     * @param bool $checkVars
     * @return bool
     */
    public function canSetProperty($name, $checkVars = false);

    /**
     * Инициализация объекта.
     * Вызывается из конструктора класса после применения конфигурационного массива.
     *
     * @return void
     */
    public function init();
}