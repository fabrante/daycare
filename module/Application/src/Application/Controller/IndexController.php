<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\LoginService;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /*
        $loginService = new LoginService();
        $loginService->logout();

        if (!$loginService->isLoggedIn()) {
            return $this->redirect()->toRoute('home', array('controller' => 'login',
                                                                'action' => 'index'));
        }
        */

        return new ViewModel();
    }
}
