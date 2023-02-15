<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function onDispatch(MvcEvent $e)
    {
        $response  = parent::onDispatch($e);
        /**
         * Retrieve the user session 
         * if it exist, 
         */
        return $response;
    }

    public function indexAction()
    {
        return new ViewModel();
    }


    /**
     * Retrieves the User information based on the available access
     *
     * @return void
     */
    public function accessAction(){
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    /**
     * logs the userinto the user Entity
     *
     * @return JsonModel
     */
    public function logAction(){
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function funnelAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }


    public function motorAction(){
        $viewModel = new ViewModel();

        return $viewModel;
    }


    public function marineCargoAction(){
        return new ViewModel();
    }

    public function travelinsuranceAction(){
        return new ViewModel();
    }
}
