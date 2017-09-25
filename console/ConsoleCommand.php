<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\console;
use PhpDevil\base\BaseController;
use PhpDevil\console\errors\ConsoleCallException;

abstract class ConsoleCommand extends BaseController
{
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