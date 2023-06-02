<?php

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Application\Service\VerifyMeService;
use Laminas\InputFilter\InputFilter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class AppController extends AbstractActionController
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
     * @var VerifyMeService
     */
    private $verifyMeService;

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function requestIdentityDataAction()
    {
        // var_dump("Herrrr");
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost();
            $inputFilter = new InputFilter();
           
            // var_dump($post);
            $inputFilter->add([
                'name' => 'email',
                'required' => true,
                "allow_empty" => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'EmailAddress',

                        'options' => array(

                            'messages' => array(
                                EmailAddress::INVALID_FORMAT => 'Please check your email something is not right'
                            )
                        )
                    ),
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
                            'messages' => array(
                                Regex::NOT_MATCH => 'Please provide a valid email address.'
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),

                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'What do we call you, we need to know'
                            )
                        )
                    ),

                    [
                        'name' => StringLength::class,
                        'options' => array(
                            'messages' => array(),
                            'min' => 2,
                            'max' => 256,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'We dont think you are Chinese',
                                StringLength::TOO_LONG => 'How to you refer to such long name'
                            )
                        ),
                    ]
                )

            ]);
            $inputFilter->add([
                'name' => 'value',
                'required' => true,
                "allow_empty" => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'What do we call you, we need to know'
                            )
                        )
                    ),

                    [
                        'name' => StringLength::class,
                        'options' => array(
                            'messages' => array(),
                            'min' => 2,
                            'max' => 256,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'We dont think you are Chinese',
                                StringLength::TOO_LONG => 'How to you refer to such long name'
                            )
                        ),
                    ]
                )
            ]);
        }

        $inputFilter->add([
            'name' => 'type',
            'required' => true,
            "allow_empty" => false,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'What do we call you, we need to know'
                        )
                    )
                ),

                [
                    'name' => StringLength::class,
                    'options' => array(
                        'messages' => array(),
                        'min' => 2,
                        'max' => 256,
                        'messages' => array(
                            StringLength::TOO_SHORT => 'We dont think you are Chinese',
                            StringLength::TOO_LONG => 'How to you refer to such long name'
                        )
                    ),
                ]
            )
        ]);
        $inputFilter->setData($post);

        if ($inputFilter->isValid()) {
            // var_dump()
            try {
                $data = $inputFilter->getValues();
                // call verifyme service
                $verifyMeService = $this->verifyMeService;
                $res =  $verifyMeService->identityVerify($data);

                $jsonModel->setVariables([
                    "data" => $res,
                ]);
                $response->setStatusCode(201);
            } catch (\Throwable $th) {
                $jsonModel->setVariables([
                    "messages" => $th->getMessage(),
                    "data" => $th->getTrace(),
                ]);
                $response->setStatusCode(400);
            }
        } else {
            $jsonModel->setVariables([
                "messages" => $inputFilter->getMessages(),
            ]);
            $response->setStatusCode(400);
        }
        return $jsonModel;
    }


    public function confirmIdentityAction(){
        $jsonModel = new JsonModel();
        return $jsonModel;
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
     * @return  VerifyMeService
     */
    public function getVerifyMeService()
    {
        return $this->verifyMeService;
    }

    /**
     * Set undocumented variable
     *
     * @param  VerifyMeService  $verifyMeService  Undocumented variable
     *
     * @return  self
     */
    public function setVerifyMeService(VerifyMeService $verifyMeService)
    {
        $this->verifyMeService = $verifyMeService;

        return $this;
    }
}
