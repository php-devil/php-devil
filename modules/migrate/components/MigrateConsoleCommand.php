<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\modules\migrate\components;
use PhpDevil\console\ConsoleCommand;

abstract class MigrateConsoleCommand extends ConsoleCommand
{
    /**
     * Путь до директории миграций
     * @var string
     */
    protected $_sourcePath = '@app/migrations';

    /**
     * Установка пути до директории миграций
     *
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->_sourcePath = $path;
        return $this;
    }
}