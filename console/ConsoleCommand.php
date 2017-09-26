<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\console;
use PhpDevil\base\BaseController;
use PhpDevil\console\errors\ConsoleCallException;
use PhpDevil\Devil;

abstract class ConsoleCommand extends BaseController
{
    protected $languagePack = null;

    /**
     * Запрос подтверждения действия у пользователя
     *
     * @param $message
     * @param array $variants
     *
     * @return mixed
     */
    public function prompt($message, $variants = ['yes' => true, 'no' => false])
    {
        if (is_array($message)) $message = Devil::t($this->languagePack, array_shift($message), $message);
        echo "\n" . $message . "\n\n";

        $handle = fopen('php://stdin', '');
        $response = null;
        while(!in_array($response, array_keys($variants))) {
            echo 'choose: (' . implode('|', array_keys($variants)) . ') > ';
            $response = trim(fgets($handle));
        }
        return $variants[$response];
    }

    /**
     * Запуск консольной команды на выполнение
     *
     * @param array $arguments
     * @return mixed
     * @throws ConsoleCallException
     */
    final public function performCommand(array $arguments = [])
    {
        if (method_exists($this, 'run')) {
            return call_user_func_array([$this, 'run'], $arguments);
        } else {
            throw new ConsoleCallException([
                'Команда {class} должна содержать метод run()',
                'class' => get_class($this),
            ]);
        }
    }
}