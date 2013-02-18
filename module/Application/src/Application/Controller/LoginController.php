<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\RestService;


use Application\Form\LoginForm;
use Application\Form\LoginValidator;

class LoginController extends AbstractActionController
{

    public function indexAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $form = new LoginForm();

        if ($request->isPost()) {
            $form  = new LoginForm();
            $formValidator = new LoginValidator();
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $arrData = $form->getData();

                $restService = new RestService($arrData, 'POST', 'rest/login');
                $restService->call($request);
            }
            else {

            }
        }
        return array('form' => $form);
    }
}
