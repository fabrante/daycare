<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;

use Application\Service\LoginService;

class IndexController extends AbstractSecureController
{
    public function indexAction()
    {
        $userName = $this->getLoginService()->getIdentity();

        return new ViewModel(array(
            'userName' => $userName
        ));
    }
}
