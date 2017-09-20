<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\localization;


use PhpDevil\base\scalar\StringHelper;
use PhpDevil\Devil;


class TranslationManager
{
    private $_language = 'ru';

    private $_loadedPackets = [
    ];

    public function setLanguage($language = 'ru')
    {
        $this->clearCache();
        $this->_language = $language;
    }

    public function translate($package, $template, array $arguments = [])
    {
        if ($package = $this->loadPackage($package)) {
            if (isset($package[$template])) $template = $package[$template];
        }
        return StringHelper::render($template, $arguments);
    }

    private function loadPackage($package)
    {

        $fileName = Devil::getPathOf($package, ['renderer' => 'translation', 'language' => $this->_language]) . '.php';
        if (!isset($this->_loadedPackets[$fileName])) {
            $packageMessages = false;
            if (file_exists($fileName)) {
                $packageMessages = require $fileName;
            } else {
                // todo: добавить fallback для локализаций для использования ru-RU, ru-UA
            }
            $this->_loadedPackets[$fileName] = $packageMessages;
        }
        return $this->_loadedPackets[$fileName];
    }

    public function clearCache()
    {
        $this->_loadedPackets = [];
    }
}