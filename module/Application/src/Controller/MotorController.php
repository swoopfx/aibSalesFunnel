<?php

namespace Application\Controller;

use Application\Entity\MotorInsurance;
use Application\Entity\User;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Application\Service\UploadService;
use Doctrine\ORM\EntityManager;
use Application\Service\FunnelSession;
use Laminas\InputFilter\InputFilter;
use Application\Service\MotorService;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Validator\File\Extension;

use Laminas\Validator\File\Size;

class MotorController extends AbstractActionController
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
     * @var UploadService
     */
    private $uploadService;


    /**
     * Undocumented variable
     *
     * @var MotorService
     */
    private $motorService;


    /**
     * Undocumented variable
     *
     * @var FunnelSession
     */
    private $funnelSession;

    private $generalService;

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }


    public function initiateMotorAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }

    public function thirdpartyAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $files = $request->getFiles()->toArray();
            $merge = array_merge($post, $files);
            $inputFilter = new InputFilter();
            $inputFilter->add([
                "name" => "ownership",
                'required' => true,
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

            $inputFilter->add([
                "name" => "license",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);
            $inputFilter->setData($merge);
            if ($inputFilter->isValid()) {
                try {
                    $data = $inputFilter->getValues();
                    $responseData = $this->motorService->thirdparty($data);

                    $jsonModel->setVariables([
                        "data" => $responseData,
                        "status" => "success"
                    ]);
                    $response->setStatusCode(201);
                } catch (\Throwable $th) {
                    $jsonModel->setVariables([
                        "messages" => $th->getMessage(),
                        "trace" => $th->getTrace(),
                    ]);
                    $response->setStatusCode(400);
                }
            } else {
                $jsonModel->setVariables([
                    "messages" => $inputFilter->getMessages(),
                ]);
                $response->setStatusCode(400);
            }
        }
        return $jsonModel;
    }

    public function comprehensiveAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $files = $request->getFiles()->toArray();
            $merge = array_merge($post, $files);
            $inputFilter = new InputFilter();
            $inputFilter->add([
                "name" => "license",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);
            $inputFilter->add([
                "name" => "valueOfCar",
                'required' => true,
                "allow_empty" => false,
                "filters" => [
                    [
                        "name" => StripTags::class
                    ],
                    [
                        "name" => StringTrim::class
                    ]
                ],
                'validators' => [      // Validators.


                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Please provide  value for your car'
                            )
                        )
                    ),
                ]
            ]);

            $inputFilter->add([
                "name" => "vNumber",
                'required' => true,
                "allow_empty" => false,
                "filters" => [
                    [
                        "name" => StripTags::class
                    ],
                    [
                        "name" => StringTrim::class
                    ]
                ],
                'validators' => [      // Validators.


                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Please provide  Vihicle License number'
                            )
                        )
                    ),
                ]
            ]);

            $inputFilter->add([
                "name" => "proofOfOwnership",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);

            $inputFilter->add([
                "name" => "meansOfId",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);

            $inputFilter->add([
                "name" => "frontImage",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);

            $inputFilter->add([
                "name" => "backImage",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);

            $inputFilter->add([
                "name" => "interiorImage",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);

            $inputFilter->add([
                "name" => "dashboardImage",
                'required' => true,
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
                            'max' => '2MB',
                            'message' => 'File too large',
                        ],
                    ],
                ]
            ]);
            $inputFilter->setData($merge);
            if ($inputFilter->isValid()) {
                try {
                    $data = $inputFilter->getValues();
                    $responseData = $this->motorService->comprehensive($data);

                    $jsonModel->setVariables([
                        "data" => $responseData,
                        "status" => "success"
                    ]);
                    $response->setStatusCode(201);
                } catch (\Throwable $th) {
                    $jsonModel->setVariables([
                        "messages" => $th->getMessage(),
                        "trace" => $th->getTrace(),
                    ]);
                    $response->setStatusCode(400);
                }
            } else {
                $jsonModel->setVariables([
                    "messages" => $inputFilter->getMessages(),
                ]);
                $response->setStatusCode(400);
            }
        }
        return $jsonModel;
    }


    public function viewAllAction()
    {
        $viewModel = new ViewModel();
        $userEntity = $this->entityManager->getRepository(User::class)->findOneBy([
            "uuid" => $this->funnelSession->getSessionUid()
        ]);
        $data = $this->entityManager->getRepository(MotorInsurance::class)->findBy([
            "user" => $userEntity->getId(),
            "isActive" => TRUE
        ], [
            "id" => "DESC",
        ], 100);
        $viewModel->setVariables([
            "data" => $data
        ]);
        return $viewModel;
    }

    /**
     * Get undocumented variable
     *
     * @return  EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set undocumented variable
     *
     * @param  EntityManager  $entityManager  Undocumented variable
     *
     * @return  self
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  FunnelSession
     */
    public function getFunnelSession()
    {
        return $this->funnelSession;
    }

    /**
     * Set undocumented variable
     *
     * @param  FunnelSession  $funnelSession  Undocumented variable
     *
     * @return  self
     */
    public function setFunnelSession(FunnelSession $funnelSession)
    {
        $this->funnelSession = $funnelSession;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  UploadService
     */
    public function getUploadService()
    {
        return $this->uploadService;
    }

    /**
     * Set undocumented variable
     *
     * @param  UploadService  $uploadService  Undocumented variable
     *
     * @return  self
     */
    public function setUploadService(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  MotorService
     */
    public function getMotorService()
    {
        return $this->motorService;
    }

    /**
     * Set undocumented variable
     *
     * @param  MotorService  $motorService  Undocumented variable
     *
     * @return  self
     */
    public function setMotorService(MotorService $motorService)
    {
        $this->motorService = $motorService;

        return $this;
    }
}
