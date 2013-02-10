<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;

use Application\Form\LoginForm;
use Application\Form\LoginValidator;

class LoginController extends AbstractActionController
{

    public function indexAction()
    {
        $request = $this->getRequest();
        $form = new LoginForm();

        if ($request->isPost()) {
            $form  = new LoginForm();
            $formValidator = new LoginValidator();
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $arrData = $form->getData();

                $client = new Client();
                $client->setAdapter('Zend\Http\Client\Adapter\Curl');
                $client->setOptions(array(
                    'maxredirects' => 0,
                    'timeout'      => 100
                ));
                $client->setUri('http://www.daycaregit.dev/rest/login');
                $client->setMethod('GET');
                $client->setHeaders(array('content-type' => 'multipart/form-data'));

                $client->setParameterGet(array('id' => $arrData['userName']));
                error_log($arrData['userName']);

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
            else {
                error_log("aquierrro");
            }
        }
        return array('form' => $form);
    }
}
