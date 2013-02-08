<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;

use Application\Form\LoginForm;

class LoginController extends AbstractActionController
{

    public function indexAction()
    {
        $form = new LoginForm();



        return new ViewModel();
    }

    public function loginAction()
    {
        $client = new Client();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');

        $client->setUri('http://www.prueba.com/rest/login');
        $client->setMethod('GET');

        var_dump($this->getForm());
        $client->setParameterPost($this->getRequest()->getPost()->toArray());

        $response = $client->send();
        if (!$response->isSuccess()) {
            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

            $response = $this->getResponse();
            $response->setContent($message);
            return $response;
        }

    }

}
