<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil;

use PhpDevil\base\localization\TranslationManager;
use PhpDevil\base\aliases\AliasManager;
use PhpDevil\base\services\ServiceLocator;


class Devil
{
    /**
     * Менеджер путей и псевдонимов
     * @var AliasManager
     */
    private static $_aliasManager = null;

    /**
     * Менеджер перевода сообщений
     * @var TranslationManager
     */
    private static $_translationManager = null;

    /**
     * Локатор служб приложения
     * @var ServiceLocator|null;
     */
    private static $_services = null;

    /**
     * Инициализация локатора служб
     *
     * @param $application
     * @param array $override
     * @return bool
     */
    public static function ensureServices($application, array $override = [])
    {
        if (null === self::$_services) {
            self::$_services = new ServiceLocator($application, $override);
        }
        return false;
    }

    /**
     * Инициализация менеджера путей при первом обращении
     * @param $class
     * @return bool
     */
    public static function ensureAliases($class = AliasManager::class)
    {
        if (null === self::$_aliasManager) {
            self::$_aliasManager = new $class();
            self::$_aliasManager->register('@core', __DIR__);
            return true;
        }
        return false;
    }

    /**
     * Инициализация менеджера локализаций текстов
     * @param string $class
     * @return bool
     */
    public static function ensureTranslations($class = TranslationManager::class)
    {
        if (null === self::$_translationManager) {
            self::$_translationManager = new $class();
            return true;
        }
        return false;
    }

    /**
     * Устанвока языка интерфейса
     * @param $language
     */
    public static function setInterfaceLanguage($language = 'ru')
    {
        static::ensureTranslations();
        self::$_translationManager->setLanguage($language);
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

    /**
     * Разворачивает псевдоним пути в реальный путь по файловой системе
     *
     * @param $alias
     * @param array $options
     * @return string
     */
    public static function getPathOf($alias, array $options = [])
    {
        self::ensureAliases();
        return self::$_aliasManager->getPathOf($alias, $options);
    }

    /**
     * Разворачивает псевдоним пути в URL адрес, если корневому ярлыку назначен
     * корневой URL
     *
     * @param $alias
     * @param array $options
     * @return string
     */
    public static function getUrlOf($alias, array $options = [])
    {
        self::ensureAliases();
        return self::$_aliasManager->getUrlOf($alias, $options);
    }

    /**
     * @param $package
     * @param $template
     * @param $arguments
     *
     * @return string
     */
    public static function t($package, $template, array $arguments = null)
    {
        self::ensureTranslations();
        return self::$_translationManager->translate($package, $template, $arguments);
    }

    /**
     * Сброс локатора служб приложения
     */
    public static function clearServices()
    {
        self::$_services = null;
        if (null !== self::$_translationManager) {
            self::$_translationManager->clearCache();
        }
    }
}