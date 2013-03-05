<?php

namespace Application\Service;



use Application\Service\AuthAdapter;


class LoginService
{

    public function login($userName, $password, $request) {

        $authAdapter = new AuthAdapter();
        $authAdapter->setFields($userName, $password, $request);
        $result = $authAdapter->authenticate();

        if ($authAdapter->hasIdentity()) {
            $authAdapter->clearIdentity();
        }

        if ($result->isValid()) {
            $authAdapter->setIdentity($result->getIdentity());
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        $authAdapter = new AuthAdapter();
        if ($authAdapter->hasIdentity()) {
            return $authAdapter->getIdentity();
        }
        return false;
    }

    public function logout() {
        $authAdapter = new AuthAdapter();
        $authAdapter->clearIdentity();
    }
}
