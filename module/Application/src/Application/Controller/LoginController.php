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



        return array('form' => $form);
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form  = new LoginForm();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $arrData = $form->getData();

                $client = new Client();
                $client->setAdapter('Zend\Http\Client\Adapter\Curl');
                $client->setUri('http://www.daycaregit.dev/rest/login');
                $client->setMethod('GET');
                $client->setHeaders(array('content-type' => 'multipart/form-data'));

                $client->setParameterGet(array('id' => $arrData['userName']));


                $response = $client->send();
                if (!$response->isSuccess()) {
                    //var_dump($response);
                    // report failure
                    $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

                    $response = $this->getResponse();
                    $response->setContent($message);
                    return $response;
                }

                $body = $response->getBody();
                var_dump($body);
            }
        }

    }

}
