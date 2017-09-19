<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil;


use PhpDevil\base\aliases\AliasManager;
use PhpDevil\base\scalar\StringHelper;

class Devil
{
    /**
     * Менеджер путей и псевдонимов
     * @var AliasManager
     */
    private static $_aliasManager = null;

    /**
     * Инициализация менеджера путей при первом обращении
     */
    protected static function ensureAliases()
    {
        if (null === self::$_aliasManager) {
            self::$_aliasManager = new AliasManager();
            self::$_aliasManager->register('@core', __DIR__);
        }
    }

    /**
     * Установка ярлыка пути
     * @param $shortcut
     * @param $path
     * @param null $url
     */
    public static function setPathOf($shortcut, $path, $url = null)
    {
        self::ensureAliases();
        self::$_aliasManager->register($shortcut, $path, $url);
    }

    public static function getPathOf($alias, array $options = [])
    {
        self::ensureAliases();
        return self::$_aliasManager->getPathOf($alias, $options);
    }

    public static function getUrlOf($alias, array $options = [])
    {
        self::ensureAliases();
        return self::$_aliasManager->getUrlOf($alias, $options);
    }

    /**
     * @param $packet
     * @param $template
     * @param $arguments
     *
     * @return string
     */
    public static function t($packet, $template, array $arguments = null)
    {
        return StringHelper::render($template, $arguments);
    }
}