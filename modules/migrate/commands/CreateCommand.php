<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\modules\migrate\commands;
use PhpDevil\base\scalar\StringHelper;
use PhpDevil\Devil;
use PhpDevil\modules\migrate\components\MigrateConsoleCommand;

/**
 * Class CreateCommand
 * Создание пустой миграции
 *
 * @package PhpDevil\modules\migrate\commands
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class CreateCommand extends MigrateConsoleCommand
{
    protected function createMigration($template, $class, $params = [])
    {
        $template = file_get_contents($template);
        if ($f = fopen(Devil::getPathOf($this->_sourcePath) . '/' . $class . '.php', 'w')) {
            fwrite($f, StringHelper::render($template, $params));
            fclose($f);
            echo "\n\n" . 'Migration ' . $class . '.php created' . "\n";
        } else {
            echo "\n\n" . 'Error: unable to create file ' . Devil::getPathOf($this->_sourcePath) . '/' . $class . '.php';
        }
    }

    public function run($comment)
    {
        $className = 'm_' . date('ymd_His') . '_' . $comment;
        echo "\n $className \n";
        if (0 === strpos($comment, 'create_table_')) {
            $tableName = substr($comment, strlen('create_table_'));
            $prompt = "\n\n" . 'Create migration ' . Devil::getPathOf($this->_sourcePath) . '/' . $className . '.php'
                . "\n" . 'with CREATE TABLE ... template?';
            if ($this->prompt($prompt)) {
                $this->createMigration(dirname(__DIR__) . '/_codegen/migration.ctpl', $className, [
                    'CLASS_NAME' => $className,
                    'TABLE_NAME' => $tableName,
                ]);
            }
        } else {
            $prompt = "\n\n" . 'Create migration ' . Devil::getPathOf($this->_sourcePath) . '/' . $className . '.php'
                . "\n" . 'with empty template?';
            if ($this->prompt($prompt)) {
                $this->createMigration(dirname(__DIR__) . '/_codegen/migration_default.ctpl', $className, [
                    'CLASS_NAME' => $className,
                ]);
            }
        }
    }
}