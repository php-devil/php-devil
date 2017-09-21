<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\services;
use PhpDevil\base\BaseComponent;
use PhpDevil\base\object\ObjectConfigureHelper;

abstract class BaseServiceContainer extends BaseComponent implements ServiceContainer
{
    /**
     * @var ServiceLocator
     */
    protected $_owner;
    protected $_registered   = [];
    protected $_instantiated = [];
    protected $_classes      = [];

    /**
     * Регистрация идентификатора службы в контейнере.
     * Службу с заданным идентификатором можно переопределять до момента ее инициализации.
     *
     * @param $id
     * @param array|object $config
     * @throws ServiceLocatorException
     */
    public function register($id, $config)
    {
        if (!isset($this->_instantiated[$id])) {
            if (is_object($config)) {
                $this->_instantiated[$id] = $config;
                $this->_registered[$id] = true;
            } else {
                $this->_registered[$id] = $config;
            }
        } else {
            throw new ServiceLocatorException([
                'Невозможно переопределить созданную службу {service}', 'service' => $id
            ]);
        }
    }

    public function has($id)
    {
        return isset($this->_instantiated[$id])
            || isset($this->_registered[$id]);
    }

    public function get($id)
    {
        if (!isset($this->_instantiated[$id])) {
            if (isset($this->_registered[$id])) {
                $this->_instantiated[$id] = ObjectConfigureHelper::instantiate($this->_registered[$id], [$id, $this]);
                $this->_registered[$id] = true;
            } else {
                throw new ServiceLocatorException([
                    'Служба {service} не определена', 'service' => $id
                ]);
            }
        }
        return $this->returnValue($this->_instantiated[$id]);
    }

    public function returnValue($object)
    {
        return $object;
    }

    public function __construct($id, ServiceLocator $locator, array $config = [])
    {
        $this->_owner = $locator;
        parent::__construct($id, $locator, $config);
    }
}