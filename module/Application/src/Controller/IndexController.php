<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\InputFilter\InputFilter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\Validator\File\Extension;
use Laminas\Validator\File\MimeType;
use Laminas\Validator\File\Size;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Service\MotorService;

class IndexController extends AbstractActionController
{

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var MotorService
     */
    private $motorService;

    /**
     * Undocumented variable
     *
     * @var GeneralService
     */
    private $generalService;

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
    public function accessAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    /**
     * logs the userinto the user Entity
     *
     * @return JsonModel
     */
    public function logAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function funnelAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }


    /**
     * This processes asychronos call for thidparty service
     *
     * @return void
     */
    public function thirdpartyAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $files = $request->getFiles()->toArray();
            $inputFilter = new InputFilter();
            $inputFilter->add([
                "name" => "",

                'validators' => [      // Validators.
                    [
                        'name' => Extension::class,
                        'options' => [
                            'extension' => 'jpg, jpeg, png, pdf',
                            'message' => 'File extension not match',
                        ],
                    ],
                    // [
                    //     'name' => MimeType::class,
                    //     'options' => [
                    //         'mimeType' => 'text/xls', 'text/xlsx',
                    //         'message' => 'File type not match',
                    //     ],
                    // ],
                    [
                        'name' => Size::class,
                        'options' => [
                            'min' => '1kB',  // minimum of 1kB
                            'max' => '4MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);
            $inputFilter->setData($files);
            if ($inputFilter->isValid()) {
                //upload document
                // generateinvoice, 
                // return invoice uid
            }
        }
        return $jsonModel;
    }

    public function comprehensiveAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function motorAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }


    public function marineCargoAction()
    {
        return new ViewModel();
    }

    public function travelinsuranceAction()
    {
        return new ViewModel();
    }

    /**
     * Get the value of entityManager
     */ 
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */ 
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * Get the value of motorService
     */ 
    public function getMotorService()
    {
        return $this->motorService;
    }

    /**
     * Set the value of motorService
     *
     * @return  self
     */ 
    public function setMotorService($motorService)
    {
        $this->motorService = $motorService;

        return $this;
    }
}
