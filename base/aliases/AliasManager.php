<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\aliases;
use PhpDevil\base\aliases\renderers\Translation;
use PhpDevil\base\scalar\StringHelper;

/**
 * Менеджер псевдонимов путей
 *
 * @package PhpDevil\base\aliases
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class AliasManager
{
    private $_aliases = [];
    private $_urls = [];

    private $_renderers = [
        'translation' => Translation::class,
    ];

    /**
     * Регистрация соответствия пути корневому ярлыку
     *
     * @param $shortcut
     * @param $path
     * @param $url
     */
    public function register($shortcut, $path, $url = null)
    {
        if (strncmp($shortcut, '@', 1)) $shortcut = '@' . $shortcut;
        if (null !== $path) {
            $this->_aliases[$shortcut] = rtrim(str_replace('\\', '/', $path), '\\/');
        }
        if (null !== $url) {
            $this->_urls[$shortcut] = $url;
        }
    }

    /**
     * Рендер пути в файловой системе по псевдониму
     *
     * @param $alias
     * @param array $options
     * @param array $source
     *
     * @return string
     * @throws InvalidAliasException
     */
    public function renderPathOf($alias, array $options = [], $source)
    {
        $renderHelper = DefaultAliasRenderer::class;
        if (isset($options['renderer'])) {
            if (isset($this->_renderers[$options['renderer']])) {
                $renderHelper = $this->_renderers[$options['renderer']];
            }
            unset($options['renderer']);
        }
        if (strncmp($alias, '@', 1)) {
            throw new InvalidAliasException(['Псевдоним пути {alias} должен начинаться с символа \'@\'', 'alias' => $alias]);
        } else {
            /** @var DefaultAliasRenderer $renderHelper $root */
            $alias = $renderHelper::beforeRender($alias, $options);
            if ($root = $this->extractRootPath($alias, $source)) {
                $template = rtrim($root . '/' . $alias, '\\/');
                if (0 === strpos($template, '//')) $template = substr($template, 1);
            } else {
                throw new InvalidAliasException(['Неизвестный псевдоним пути {alias}', 'alias' => $alias]);
            }
            return $renderHelper::afterRender(StringHelper::render($template, $options));
        }
    }

    /**
     * Получение пути, соответсвующего псевдониму
     *
     * @param $alias
     * @param array $options
     * @return string
     */
    public function getPathOf($alias, array $options = [])
    {
        return $this->renderPathOf($alias, $options, $this->_aliases);
    }

    /**
     * Получение url адреса, соответствующего псевдониму
     *
     * @param $alias
     * @param array $options
     * @return string
     */
    public function getUrlOf($alias, array $options = [])
    {
        return $this->renderPathOf($alias, $options, $this->_urls);
    }

    /**
     * Путь, назначенный ярлыку, использованному в псевдониме
     *
     * @param &$alias
     * @param $source
     * @return string|null
     */
    protected function extractRootPath(&$alias, $source)
    {
        if (false !== ($pos = strpos($alias, '/'))) {
            $shortcut = substr($alias, 0, $pos);
            if (isset($source[$shortcut])) {
                $alias = substr($alias, $pos + 1);
                return $source[$shortcut];
            }
        } elseif (isset($source[$alias])) {
            $result = $source[$alias];
            $alias = null;
            return $result;
        }
        return null;
    }
}