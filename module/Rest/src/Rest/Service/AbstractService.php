<?php

namespace Rest\Service;

use \Zend\ServiceManager\FactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractService implements FactoryInterface
{
    private $serviceLocator;
    protected $model;
    protected $modelName = "";

    public function getModel()
    {
        return (!$this->model ? $this->getServiceLocator()->get($this->modelName) : $this->model);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getAll() {
        return $this->getModel()->fetchAll();
    }

    public function getById($id) {
        return $this->getModel()->getById($id);
    }

}
