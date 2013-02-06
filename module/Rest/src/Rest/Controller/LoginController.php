<?php
namespace Rest\Controller;

use Zend\View\Model\JsonModel;

class LoginController extends UserController
{
    public function get($id)
    {
        $object = $this->getDefaultService()->getUserLogin($id);
        if ($object != null) {


            return new JsonModel(array($object->toArray()));
        }
        else {
            $this->setNotFound();
        }
    }
}