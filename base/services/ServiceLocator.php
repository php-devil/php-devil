<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\services;
use PhpDevil\base\BaseApplication;
use PhpDevil\base\BaseObject;
use PhpDevil\base\object\ObjectConfigureHelper;

/**
 * Локатор служб приложения
 *
 * @property ComponentsContainer $components
 * @property ModelsContainer $models
 * @property ModulesContainer $modules
 *
 * @package PhpDevil\base\services
 * @author Alexey Volkov <avolkov.webwizardry@gmail.com>
 */
class ServiceLocator extends BaseObject
{
    /**
     * @var BaseApplication
     */
    private $_application = null;

    /**
     * Контейнеры для хранения объектов
     * @var ServiceContainer array
     */
    private $_containers = [];

    const COMPONENT = 'components';
    const MODULE    = 'modules';
    const MODEL     = 'models';

    /**
     * @return array
     */
    public static function configurationDefault()
    {
        return [
            'containers' => [
                'components' => ['class' => ComponentsContainer::class],
                'modules'    => ['class' => ModulesContainer::class],
                'models'     => ['class' => ModelsContainer::class]
            ],
        ];
    }

    public function clear()
    {
        $this->_application = null;
        foreach ($this->_containers as $container) $container->clear();
    }

    /**
     * При наличии контейнера с заданным именем возвращает указанный контейнер, в
     * противном случае - пытается вернуть значение свойства
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, [self::MODULE, self::MODEL, self::COMPONENT])) {
            return $this->_containers[$name];
        } else {
            return parent::__get($name);
        }
    }

    /**
     * Конфигуратор вложенных контейнеров
     * @param array $containers
     */
    public function setContainers(array $containers)
    {
        foreach ($containers as $name=>$configuration) {
            $this->_containers[$name] = ObjectConfigureHelper::instantiate($configuration, [$name, $this]);
        }
    }

    /**
     * Конструктор службы.
     * Владельцем службы является фронт-контроллер приложения.
     *
     * @param array $application
     * @param array $config
     */
    public function __construct($application, array $config = [])
    {
        $this->_application = $application;
        parent::__construct($config);
    }
}