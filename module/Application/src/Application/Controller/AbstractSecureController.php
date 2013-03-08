<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;

use Application\Service\LoginService;

abstract class AbstractSecureController extends AbstractActionController
{
    private $loginService;

    public function dispatch(Request $request, Response $response = null)
    {
        $this->loginService = new LoginService();

        if (!$this->loginService->isLoggedIn()) {
            return $this->redirect()->toUrl('/login');
        }

        return parent::dispatch($request, $response);
    }

    public function setLoginService($loginService)
    {
        $this->loginService = $loginService;
    }

    public function getLoginService()
    {
        return $this->loginService;
    }



}
