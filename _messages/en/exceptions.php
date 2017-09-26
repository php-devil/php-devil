<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 *
 * Локализация сообщений системных исключений для английского языка
 */

return [
    'Псевдоним пути {alias} должен начинаться с символа \'@\'' => 'The alias of the path {alias} must begin with a symbol \'@\'',
    'Неизвестный псевдоним пути {alias}' => 'Unknown path alias {alias}',

    'Свойство {class}::{property} доступно только для чтения' => 'The property {class}::{property} is read-only',
    'Свойство {class}::{property} доступно только для записи' => 'The property {class}::{property} is write-only',
    'Свойство {class}::{property} не определено' => 'The property {class}::{property} is unknown',

    'Невозможно переопределить созданную службу {service}' => 'Service {service} has an instance and can\'t be redefined',
    'Служба {service} не определена' => 'Unknown service {service}',

    'Для создания экземпляра класса модели используйте {class}::model(array $attributes = []);' => 'Use {class}::model(array $attributes = []); to instantiate a model',

    'Не установлено обязательное свойство {class}::{property}' => 'Required property {class}::{property} is missed',

    'Не определен класс в конфигурационном массиве {array}' => 'Configuration array must to define class name {array}',

    'Не указан маршрут команды' => 'Command route is empty',
    'Команда {class} должна содержать метод run()' => 'Console command\'s method {class}::run() is not declared',
];
