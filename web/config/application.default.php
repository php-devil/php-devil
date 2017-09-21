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

        'user' => \PhpDevil\components\user\User::class,


    ],
];