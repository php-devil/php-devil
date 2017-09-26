<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\modules\migrate\migrations;
use PhpDevil\database\Migration;
use PhpDevil\modules\migrate\models\MigrationLog;

class InitialMigration extends Migration
{
    public static function tableName()
    {
        return MigrationLog::tableName();
    }

    public function up()
    {
        $this->createTable(static::tableName(), [
            'id'         => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->notNull(),
        ]);
    }

    public function down($soft = false)
    {
        $this->dropTable(static::tableName(), $soft);
    }
}