<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\modules\migrate\commands;
use PhpDevil\components\db\Connection;
use PhpDevil\Devil;
use PhpDevil\modules\migrate\components\MigrateConsoleCommand;
use PhpDevil\modules\migrate\migrations\InitialMigration;

class UpCommand extends MigrateConsoleCommand
{
    public function run()
    {
        $db = Devil::container()->components->get('db');

        /** @var Connection $db */
        if (!$db->schema->findTable(InitialMigration::tableName())->exists) {
            (new InitialMigration())->up();
        } else {

        }


    }
}