<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 *
 * Конфигуратор веб-приложения по умолчанию
 */

return [
    'components' => [
        'session' => [
            'class'   => \PhpDevil\components\session\Session::class,
            'storage' => \PhpDevil\components\session\storage\DefaultStorage::class,
            'name'    => 'php-devil-app',
        ],

        'user' => ['class' => \PhpDevil\components\user\User::class],
        'db'   => ['class' => \PhpDevil\components\db\Connection::class],


    ],
];