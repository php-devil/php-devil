<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\object;
use PhpDevil\base\BaseException;
use Throwable;

/**
 * Class RequiredParamException
 * Исключение возникает, если на этапе инициализации не установлено обязательное свойство
 * объекта или компонента
 *
 * @package PhpDevil\base\object
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class RequiredParamException extends BaseException
{
    public function __construct($message = "", $code = 0, $previous = null)
    {
        if (is_array($message)) {
            $message = ['Не установлено обязательное свойство {class}::{property}',
                'class' => $message[0],
                'property' => $message[1],
            ];
        }
        parent::__construct($message, $code, $previous);
    }
}