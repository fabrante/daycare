<?php
namespace Rest\Controller;

use Rest\Controller\AbstractSecureController;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

abstract class AbstractRestController extends AbstractSecureController
{
    protected $defaultServiceName;
    protected $defaultService;

    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList()
    {
        $objects = $this->getDefaultService()->getAll();
        if ($objects != null) {
            $jsonArr = array();
            foreach ($objects as $object) {
                array_push($jsonArr, $object->toArray());
            }
            return new JsonModel($jsonArr);
        }
        else {
            $this->setNotFound();
        }
    }

    /**
     * Return single resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        $object = $this->getDefaultService()->getById($id);
        if ($object != null) {
            return new JsonModel(array($object->toArray()));
        }
        else {
            $this->setNotFound();
        }
    }

    public function getDefaultService()
    {
        return (!$this->defaultService ? $this->getServiceLocator()->get($this->defaultServiceName) : $this->defaultService);
    }

    protected  function setNotFound() {
        $this->getResponse()->setStatusCode(404);
    }
}
