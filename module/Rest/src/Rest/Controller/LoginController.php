<?php
namespace Rest\Controller;

use Zend\View\Model\JsonModel;

class LoginController extends UserController
{
    public function create($data)
    {
        $object = $this->getDefaultService()->getUserLogin($data["userName"], $data["userPassword"]);
        if ($object != null) {
            return new JsonModel(array($object->toArray()));
        }
        else {
            $this->setNotFound();
        }
    }
}