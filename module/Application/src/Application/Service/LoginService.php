<?php

namespace Application\Service;



use Application\Service\AuthAdapter;


class LoginService
{
    private $authAdapter;


    function __construct()
    {
        $this->authAdapter = new AuthAdapter();;
    }

    public function login($userName, $password, $request) {

        $this->authAdapter->setFields($userName, $password, $request);
        $result = $this->authAdapter->authenticate();

        if ($this->authAdapter->hasIdentity()) {
            $this->authAdapter->clearIdentity();
        }

        if ($result->isValid()) {
            $this->authAdapter->setIdentity($result->getIdentity());
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        if ($this->authAdapter->hasIdentity()) {
            return $this->authAdapter->getIdentity();
        }
        return false;
    }

    public function logout() {
        $this->authAdapter->clearIdentity();
    }

    public function getIdentity() {
        return $this->authAdapter->getIdentity();
    }
}
