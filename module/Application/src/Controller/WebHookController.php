<?php

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;

class WebHookController extends AbstractActionController{

    public function qoreidHookAction(){
        $jsonModel = new JsonModel();
        return $jsonModel;
    }

    
}