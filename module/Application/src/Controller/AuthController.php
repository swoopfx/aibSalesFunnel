<?php

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;

class AuthController extends AbstractActionController{



    public function indexAction(){

    }


    public function loginAction(){

    }

    public function registerAction(){
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        if($request->isPost()){
            $post = $request->getPost()->toArray();
        }

        return $jsonModel;
    }
}