<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;


use Application\Model\User;
use Application\Service\LoginService;

//http://samsonasik.wordpress.com/2012/10/23/zend-framework-2-create-login-authentication-using-authenticationservice-with-rememberme/
//http://framework.zend.com/manual/2.0/en/modules/zend.authentication.intro.html

class LoginController extends AbstractActionController
{
    protected $form;


    public function indexAction()
    {
        $request = $this->getRequest();
        $form = $this->getForm();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $arrData = $form->getData();

                $loginService = new LoginService();
                if ($loginService->login($arrData['userName'], $arrData['userPassword'], $request)) {
                    return $this->redirect()->toUrl('/');
                }
                else {
                    //TODO: internacionalizar
                    $form->setMessages(array(
                        'userName' => array("Usuario o Password invalido")
                    ));
                }
            }
        }
        return array('form' => $form);
    }

    public function getForm()
    {
        if (! $this->form) {
            $user       = new User();
            $builder    = new AnnotationBuilder();
            $this->form = $builder->createForm($user);
        }

        return $this->form;
    }
}
