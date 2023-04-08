<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Country;
use Application\Entity\Gender;
use Application\Entity\Invoice;
use Application\Entity\Settings;
use Application\Entity\User;
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
use Application\Service\FunnelSession;
use Doctrine\ORM\Query;
use Laminas\Session\Container;
use Application\Form\RegisterInputFilter;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;
use Application\Service\MailService;
use Application\Service\MailtrapService;

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

    /**
     * Undocumented variable
     *
     * @var RegisterInputFilter
     */
    private $registerInputFilter;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $mailService;

    private $mailly;

    /**
     * Undocumented variable
     *
     * @var MailtrapServ
     */
    private $mailtrap;


    /**
     * Undocumented variable
     *
     * @var FunnelSession
     */
    private $funnelSession;

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
        try {
            $this->mailly->send("it", [
                'from' => 'it@aibltd.insure',
                'to' => ['otabayomi@gmail.com'],
                'subject' => 'Mail Jet Greetings!',
                'body' => 'Inside Trading',
            ]);
        } catch (\Throwable $th) {
            // var_dump($th->getTraceAsString())."<br>";
            echo $th->getMessage();
        }

        return new ViewModel();
    }

    public function editProfileAction()
    {

        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            try {
                $post = $request->getPost()->toArray();
                $inputFilter = new InputFilter();
                $inputFilter->add([
                    'name' => 'phonenumber',
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
                                    'isEmpty' => 'Identity is required'
                                )
                            )
                        ),
                        // [
                        //     "name" => NoObjectExists::class,
                        //     "options" => [
                        //         "use_context" => true,
                        //         "object_repository" => $this->entityManager->getRepository(User::class),
                        //         "objject_manager" => $this->entityManager,
                        //         "fields" => [
                        //             "phonenumber"
                        //         ],
                        //         "messages" => [
                        //             NoObjectExists::ERROR_NO_OBJECT_FOUND => "please use another Phone number"
                        //         ]
                        //     ]
                        // ],
                        [
                            'name' => StringLength::class,
                            'options' => array(
                                'messages' => array(),
                                'min' => 10,
                                'max' => 11,
                                'messages' => array(
                                    StringLength::TOO_SHORT => 'Please provide a valid number',
                                    StringLength::TOO_LONG => 'We think this is not a valid Phone Number'
                                )
                            ),
                        ]
                    )
                ]);
                $inputFilter->add([
                    'name' => 'fullname',
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
                $inputFilter->setData($post);
                $inputFilter->setValidationGroup([
                    "email",
                    "fullname",
                    "phonenumber"
                ]);
                if ($inputFilter->isValid()) {
                    $data = $inputFilter->getValues();
                    $sessionuid = $this->funnelSession->getSessionUid();
                    /**
                     * @var User
                     */
                    $userEntity = $this->entityManager->getRepository(User::class)->findoneBy([
                        "uuid" => $sessionuid,
                    ]);
                    $userEntity->setEmail($data["email"])->setUpdatedOn(new \Datetime())
                        ->setPhonenumber($data["phonenumber"])
                        ->setFullname($data["fullname"]);

                    $this->entityManager->persist($userEntity);
                    $this->entityManager->flush();

                    $response->setStatusCode(202);
                } else {
                    $jsonModel->setVariables([
                        "messages" => $inputFilter->getMessages()
                    ]);
                }
            } catch (\Throwable $th) {
                $jsonModel->setVariables([
                    "messages" => $th->getMessage()
                ]);
            }
        }
        return $jsonModel;
    }

    public function getProfileDataAction()
    {
        $jsonModel = new JsonModel();
        $em = $this->entityManager;
        $sessionuid = $this->funnelSession->getSessionUid();
        if ($sessionuid == NULL) {
            $jsonModel->setVariables([]);
        } else {
            $repo = $em->getRepository(User::class);
            $data = $repo->createQueryBuilder("s")->select("s")
                ->where("s.uuid = :uuid")
                ->setParameters([
                    "uuid" => $sessionuid
                ])->getQuery()
                ->getResult(Query::HYDRATE_ARRAY);

            $jsonModel->setVariables([
                "data" => $data
            ]);
        }
        return $jsonModel;
    }

    public function profileAction()
    {
        $viewModel = new ViewModel();
        $sessionuid = $this->funnelSession->getSessionUid();
        if ($sessionuid == null) {
            return $this->redirect()->toRoute("home");
        } else {
            $userEntity = $this->entityManager->getRepository(User::class)->findoneBy([
                "uuid" => $sessionuid,
            ]);
        }
        $viewModel->setVariables([
            "data" => $userEntity
        ]);

        return $viewModel;
    }

    public function getsexAction()
    {
        $em = $this->entityManager;
        $jsonModel = new JsonModel();
        $data = $em->getRepository(Gender::class)->createQueryBuilder("s")->getQuery()->getArrayResult();
        $jsonModel->setVariables([
            "data" => $data,
        ]);
        return $jsonModel;
    }


    public function getCountryAction()
    {
        $em = $this->entityManager;
        $jsonModel = new JsonModel();
        $data = $em->getRepository(Country::class)->createQueryBuilder("s")->getQuery()->getArrayResult();
        $jsonModel->setVariables([
            "data" => $data,
        ]);
        return $jsonModel;
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

    public function invoiceAction()
    {
        $viewModel = new ViewModel();
        $parameter = $this->params()->fromRoute("id", null);
        if ($parameter == null) {
            $this->flashmessenger()->addErrorMessage("Invoice Identifier is absent");
            $this->redirect()->toRoute("home");
        } else {
            /**
             * @var Invoice
             */
            $invoiceEntity = $this->entityManager->getRepository(Invoice::class)->findOneBy([
                "invoiceUuid" => strip_tags($parameter)
            ]);
            if ($invoiceEntity == null) {
                $this->flashmessenger()->addErrorMessage("Invoice Identifier is absent");
                $this->redirect()->toRoute("home");
            }
            /**
             * @var Settings
             */
            $settings = $this->entityManager->find(Settings::class, 1);

            $container = new Container("invoicesession");
            $container->invoiceref = $invoiceEntity->getInvoiceUid();
            $container->amount = $invoiceEntity->getAmount();
            $container->email = $invoiceEntity->getUser()->getEmail();
            $container->pkey = $settings->getPaystackKey();

            $viewModel->setVariables([
                "data" => $invoiceEntity,
                "setting" => $settings
            ]);
        }
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


    public function invoiceSettingAction()
    {
        $jsonModel = new JsonModel();
        $em = $this->entityManager;
        $repo = $em->getRepository(Settings::class);
        // $data = $em->createQueryBuilder("l")->get
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
        $request = $this->getRequest();
        $cookie = $request->getHeaders()->get("Cookie");
        // var_dump($cookie->igibber);

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
     * @return  RegisterInputFilter
     */
    public function getRegisterInputFilter()
    {
        return $this->registerInputFilter;
    }

    /**
     * Set undocumented variable
     *
     * @param  RegisterInputFilter  $registerInputFilter  Undocumented variable
     *
     * @return  self
     */
    public function setRegisterInputFilter(RegisterInputFilter $registerInputFilter)
    {
        $this->registerInputFilter = $registerInputFilter;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  [type]
     */
    public function getMailService()
    {
        return $this->mailService;
    }

    /**
     * Set undocumented variable
     *
     * @param   $mailService  Undocumented variable
     *
     * @return  self
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;


        return $this;
    }

    /**
     * Get the value of mailly
     */
    public function getMailly()
    {
        return $this->mailly;
    }

    /**
     * Set the value of mailly
     *
     * @return  self
     */
    public function setMailly($mailly)
    {
        $this->mailly = $mailly;

        return $this;
    }
}
