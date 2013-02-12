<?php
namespace Rest\Controller;

use Zend\View\Model\JsonModel;

class LoginController extends UserController
{
    public function create($data)
    {
        var_dump($data);
        $object = $this->getDefaultService()->getUserLogin($data['user'], $data['pass']);
        if ($object != null) {
            return new JsonModel(array($object->toArray()));
        }
        else {
            $this->setNotFound();
        }
    }
}