<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base;
use PhpDevil\Devil;
use Throwable;

abstract class BaseException extends \Exception
{
    /**
     * @var null|array
     */
    private $_messageOrigin = null;

    /**
     * Языковой пакет по умолчанию
     * @var string
     */
    public $languagePacket = '@core{...}exceptions';

    /**
     * Конструктор исключения.
     * Если в качестве сообщения передан массив, сообщение будет переведено из
     * расчета нулевой элемент массива - шаблон сообщения, остальные - аргументы сообщения
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (is_array($message)) {
            $this->_messageOrigin = $message;
            $template = array_shift($message);
            $message = Devil::t($this->languagePacket, $template, $message);
        }
        parent::__construct($message, $code, $previous);
    }
}