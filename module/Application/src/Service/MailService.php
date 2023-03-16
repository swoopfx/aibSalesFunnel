<?php

namespace Application\Service;

use Application\Entity\Settings;
use Laminas\Mail\Message as MailMessage;
use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\Mime\Message;
use Laminas\Mime\Mime;
use Laminas\Mime\Part;
use Laminas\View\Renderer\RendererInterface;
use Doctrine\ORM\EntityManager;



class MailService
{


    private $stmpConfig;


    /**
     * Undocumented variable
     *
     * @var  EntityManager
     */
    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var SmtpTransport
     */
    private $smtpTransport;


    /**
     * 
     *
     * @var SmtpOptions
     */
    private $smtpOptions;


    /**
     * Undocumented variable
     * @var  RendererInterface
     *
     */
    private $viewRenderer;



    /**
     * Undocumented function
     *
     * @param array $data include 'template', 'var', 'to', 'toName', 'subject
     * @return void
     */
    public function execute(array $data)
    {
        /**
         * @var Settings
         */
        $settingEntity = $this->entityManager->find(Settings::class, 1);
        $bodyHtml = $this->viewRenderer->render($data["template"], $data["var"]);
        $html = new Part($bodyHtml);
        $html->type = Mime::TYPE_HTML;
        $html->charset = "utf-8";
        $body = new Message();
        $body->addPart($html);
        $mail = new MailMessage();
        $mail->setEncoding("UTF-8");
        $mail->setBody($body);
        $mail->setFrom($settingEntity->getCompanyEmailSender(), $settingEntity->getCompanyName());
        $mail->addTo($data["to"], $data["toName"]);
        $mail->setSubject($data["subject"]);

        $this->smtpTransport->setOptions($this->smtpOptions);
        $this->smtpTransport->send($mail);
    }




    /**
     * Get the value of stmpConfig
     */
    public function getStmpConfig()
    {
        return $this->stmpConfig;
    }

    /**
     * Set the value of stmpConfig
     *
     * @return  self
     */
    public function setStmpConfig($stmpConfig)
    {
        $this->stmpConfig = $stmpConfig;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  SmtpTransport
     */
    public function getSmtpTransport()
    {
        return $this->smtpTransport;
    }

    /**
     * Set undocumented variable
     *
     * @param  SmtpTransport  $smtpTransport  Undocumented variable
     *
     * @return  self
     */
    public function setSmtpTransport(SmtpTransport $smtpTransport)
    {
        $this->smtpTransport = $smtpTransport;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  SmtpOptions
     */
    public function getSmtpOptions()
    {
        return $this->smtpOptions;
    }

    /**
     * Set undocumented variable
     *
     * @param  SmtpOptions  $smtpOptions  Undocumented variable
     *
     * @return  self
     */
    public function setSmtpOptions(SmtpOptions $smtpOptions)
    {
        $this->smtpOptions = $smtpOptions;

        return $this;
    }

    /**
     * Get undocumented variable
     */
    public function getViewRenderer()
    {
        return $this->viewRenderer;
    }

    /**
     * Set undocumented variable
     *
     * @return  self
     */
    public function setViewRenderer($viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;

        return $this;
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
}
