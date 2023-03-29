<?php

namespace Admin\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\Plugin\Redirect;

class RedirectPlugin extends AbstractPlugin
{

    /**
     * Undocumented variable
     *
     * @var AuthenticationService
     */
    private $auth;

    /**
     * Undocumented variable
     *
     * @var Redirect
     */
    private $redirect;

    public function redirectToLogout()
    {
        if (!$this->auth->hasIdentity()) {
            $this->redirect->toRoute("logout");
        }
    }

    /**
     * Get the value of auth
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Set the value of auth
     *
     * @return  self
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;

        return $this;
    }

    /**
     * Get the value of redirect
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set the value of redirect
     *
     * @return  self
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }
}
