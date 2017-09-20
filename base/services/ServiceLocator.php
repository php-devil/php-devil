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

    public function setContainers(array $containers)
    {
        foreach ($containers as $name=>$configuration) {
            $this->_containers[$name] = ObjectConfigureHelper::instantiate($configuration);
        }
    }

    public function __construct($application, array $config = [])
    {
        $this->_application = $application;
        parent::__construct($config);
    }
}