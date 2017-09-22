<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\database;
use PhpDevil\base\BaseObject;

/**
 * Class Migration.
 * Миграция реализует изменение структуры базы данных
 *
 * @package PhpDevil\database
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
abstract class Migration extends BaseObject
{
    /**
     * Применение миграции
     * @return mixed
     */
    abstract public function up();

    /**
     * Откат миграции
     * @return mixed
     */
    abstract public function down();
}