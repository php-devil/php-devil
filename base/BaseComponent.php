<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;

/**
 * Class BaseComponent
 * Расширение базового объекта.
 * Кроме свойств компонент также реализует события и поведения.
 *
 * @package PhpDevil\base
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class BaseComponent extends BaseObject
{
    protected $_owner = null;

    public function __construct($id, $owner, array $config = [])
    {
        $this->_owner = null;
        parent::__construct($config);
    }
}