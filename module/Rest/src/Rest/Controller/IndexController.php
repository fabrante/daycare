<?php
namespace Rest\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction() {
        error_log("rest index");
        return new ViewModel();
    }

}
