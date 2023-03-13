<?php

namespace Application\Service;

use Exception;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\ContactsApi;
use SendinBlue\Client\Model\CreateContact;
use SendinBlue\Client\Model\CreateUpdateContactModel;

class SendInBlueMarketing
{

    private $credentials;

    public function createContact($data)
    {
        // var_dump($data["sms"]);
        $apiinstance = new ContactsApi(new Client(), $this->credentials);
        $name = explode(" ", $data["fullname"]);
        $createContact = new CreateContact([
            'email' => $data['email'],
            'updateEnabled' => true,
            'attributes' => ['FIRSTNAME' => $name[0], 'LASTNAME' => $name[1], 'isVIP' => 'true'],
            'listIds' => [100]
        ]);
        try {
            $apiinstance->createContact($createContact);
        } catch (\Throwable $th) {
            throw new \Exception("Exception when calling ContactsApi->createContact: {$th->getMessage()}");
        }
    }

    /**
     * Get the value of credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set the value of credentials
     *
     * @return  self
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }
}
