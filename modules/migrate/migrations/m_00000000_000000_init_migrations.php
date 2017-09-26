<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

/**
 * Class m_00000000_000000_init_migrations
 * Инициализация журнала примененных миграций
 *
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class m_00000000_000000_init_migrations extends \PhpDevil\database\Migration
{
    public function up()
    {
        $this->createTable('migrations', [
            'id'      => $this->string()->notNull()->unique(),
            'applied' => $this->integer()->notNull()->defaultExpression(),
        ]);
    }

    public function down($soft = false)
    {
        $this->dropTable('migrations', $soft);
    }
}