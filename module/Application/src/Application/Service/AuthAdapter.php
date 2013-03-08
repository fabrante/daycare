<?php

namespace Application\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Authentication\Result;

class AuthAdapter implements AdapterInterface
{
    private $userName;
    private $password;
    private $request;

    protected $storage = null;

    function __construct()
    {


        $this->storage = new Session('AuthNameSpace');
    }

    public function setFields($userName, $password, $request) {
        $this->password = $password;
        $this->request = $request;
        $this->userName = $userName;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {

        $result = array(
            'code'  => Result::FAILURE,
            'identity' => array(
                'userName' => $this->userName,
            ),
            'messages' => array()
        );

        $restService = new RestService($this->createArrData(), 'POST', 'rest/login');
        $response = $restService->call($this->request);

        if ($response->getStatusCode() == 200) {
            $result['code'] = Result::SUCCESS;
        }
        else {
            return new Result(
                Result::FAILURE_CREDENTIAL_INVALID,
                array(),
                array('Failure due to invalid credential being supplied')
            );
        }
        return new Result($result['code'], $result['identity'], $result['messages']);
    }

    private function createArrData() {
        return array('userName' => $this->userName,
                    'userPassword' => $this->password);
    }

    public function setIdentity($identity) {
        $this->getStorage()->write($identity);
    }

    /**
     * Returns true if and only if an identity is available from storage
     *
     * @return boolean
     */
    public function hasIdentity()
    {
        return !$this->getStorage()->isEmpty();
    }

    /**
     * Returns the identity from storage or null if no identity is available
     *
     * @return mixed|null
     */
    public function getIdentity()
    {
        $storage = $this->getStorage();

        if ($storage->isEmpty()) {
            return null;
        }

        return $storage->read();
    }

    /**
     * Clears the identity from persistent storage
     *
     * @return void
     */
    public function clearIdentity()
    {
        $this->getStorage()->clear();
    }

    public function getStorage()
    {
        return $this->storage;
    }


}
