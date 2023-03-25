<?php

namespace Admin\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\SessionManager;
use Laminas\View\Model\ViewModel;
use Application\Entity\User;
use Laminas\InputFilter\InputFilter;
use Laminas\View\Model\JsonModel;

class AuthController extends AbstractActionController
{

    private $entityManager;

    private $authService;

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        // $this->customerRedirectPlugin()->totalRedirection();
        $this->layout()->setTemplate('layout/admin-login');
        return $response;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function loginAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function loginjsonAction()
    {

        // $data = $inputFilter->getValues();
        $user = $this->identity();
        if ($user) {
            return $this->redirect()->toRoute("home");
        }
        $jsonModel = new JsonModel();
        $response = $this->getResponse();
        // $data = $inputFilter->getValues();

        $uri = $this->getRequest()->getUri();
        // var_dump($uri);
        $fullUrl = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
        // use the generated controllerr plugin for the redirection

        // $form = $this->loginForm->createUserForm($this->userEntity, 'login');
        $messages = null;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'email',
                'required' => true,
                'allow_empty' => false,
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
                                'isEmpty' => 'Phone number or email is required'
                            )
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'password',
                'required' => true,
                'allow_empty' => false,
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
                                'isEmpty' => 'Password is required'
                            )
                        )
                    )
                )
            ));

            $inputFilter->setData($post);
            if ($inputFilter->isValid()) {
                $data = $inputFilter->getValues();

                $authService = $this->authService;
                $adapter = $authService->getAdapter();
                $email = $data["email"];

                try {
                    $user = $this->entityManager->createQuery("SELECT u FROM  Application\Entity\User u WHERE u.email = '$email' ")->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);

                    // $user = $this->user->selectUserDQL($phoneOrEmail);
                    if (count($user) == 0) {
                        $response->setCustomStatusCode(498);
                        $response->setReasonPhrase('Invalid token!');
                        return $jsonModel->setVariables([
                            "messages" => "The username or email is not valid!"
                        ]);
                    } else {
                        $user = $user[0];
                    }

                    // var_dump($user);
                    // var_dump($user);
                    // if ($user == NULL) {

                    // $messages = 'The username or email is not valid!';
                    // // return new ViewModel(array(
                    // // 'error' => $this->translatorHelper->translate('Your authentication credentials are not valid'),
                    // // 'form' => $form,
                    // // 'messages' => $messages,
                    // // 'navMenu' => $this->options->getNavMenu()
                    // // ));

                    // $response->setStatusCode(Response::STATUS_CODE_422);
                    // return $jsonModel->setVariables([
                    // "messages" => $messages
                    // ]);
                    // }
                    // if (! $user->getEmailConfirmed() == 1) {
                    //     $messages = $this->translatorHelper->translate('You are yet to confirm your account, please go to the registered email to confirm your account');
                    //     $response->setStatusCode(Response::STATUS_CODE_422);
                    //     return $jsonModel->setVariables([
                    //         "messages" => $messages
                    //     ]);
                    // }
                    if (!$user->getIsActive()) {
                        $messages = 'Your username is disabled. Please contact an administrator.';
                        $response->setStatusCode(Response::STATUS_CODE_422);
                        return $jsonModel->setVariables([
                            "messages" => $messages
                        ]);
                    }

                    $adapter->setIdentity($user->getEmail());
                    $adapter->setCredential($data["password"]);

                    $authResult = $authService->authenticate();
                    // $class_methods = get_class_methods($adapter);
                    // echo "<pre>";print_r($class_methods);exit;

                    if ($authResult->isValid()) {
                        $identity = $authResult->getIdentity();
                        $authService->getStorage()->write($identity);

                        // Last Login Date
                        $this->lastLogin($this->identity());
                        $userEntity = $this->identity();
                        if ($this->params()->fromPost('rememberme')) {
                            $time = 1209600; // 14 days (1209600/3600 = 336 hours => 336/24 = 14 days)
                            $sessionManager = new SessionManager();
                            $sessionManager->rememberMe($time);
                        }

                        // var_dump($this->identity());
                        /**
                         * At this region check if the user varible isProfiled is true
                         * If it is true make sure continue with the login
                         * If it is false branch into the condition get the user role mand seed it to
                         * the userProfile Sertvice
                         * to display the required form to fill the profile
                         * if required redirect to the copletinfg profile Page
                         */
                        $redirect = $fullUrl . "/admin/dashboard";

                        $response->setStatusCode(201);
                        $jsonModel->setVariables([
                            "redirect" => $redirect
                        ]);
                        $jsonModel->setVariables([]);
                        return $jsonModel;
                        // return $this->redirect()->toRoute($this->options->getLoginRedirectRoute());
                    } else {
                        $messages = 'Invalid Credentials';
                        $response->setStatusCode(Response::STATUS_CODE_422);
                        return $jsonModel->setVariables([
                            "messages" => $messages
                        ]);
                    }

                    foreach ($authResult->getMessages() as $message) {
                        $messages .= "$message\n";
                    }
                } catch (\Exception $e) {
                    // echo "Something went wrong";
                    // return $this->errorView->createErrorView($this->translatorHelper->translate('Something went wrong during login! Please, try again later.'), $e, $this->options->getDisplayExceptions(), $this->options);
                    // ->getNavMenu();
                    $response->setStatusCode(Response::STATUS_CODE_400);
                    return $jsonModel->setVariables([
                        "messages" => 'Something went wrong during login! Please, try again later.',
                        "data" => $e->getMessage(),
                    ]);
                }
            }
        }

        $response->setStatusCode(Response::STATUS_CODE_500);
        $jsonModel->setVariables([
            'messages' => "Some thing went wrong"
        ]);
        return $jsonModel;

        // 'navMenu' => $this->options->getNavMenu()
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
     * Get the value of authService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set the value of authService
     *
     * @return  self
     */
    public function setAuthService($authService)
    {
        $this->authService = $authService;

        return $this;
    }
}
