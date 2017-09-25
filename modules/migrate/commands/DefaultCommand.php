<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\modules\migrate\commands;
use PhpDevil\modules\migrate\components\MigrateConsoleCommand;

class DefaultCommand extends MigrateConsoleCommand
{
    public function run($comment)
    {
        echo $comment;
    }
}