<?php

namespace Application\Service;

use Exception;
use SendGrid;

class TwilioSendgridService
{

    /**
     * Twillio Configuration File
     *
     * @var array
     */
    private $twilioConfig;

    /**
     * Undocumented variable
     *
     * @var Sendgrid
     */
    private $sendgridClient;

    public function  createContact($data)
    {
        $sg = $this->sendgridClient;
        //         $request_body = json_decode('{
        //     "contacts": [
        //         {
        //             "email": $data[,
        //             "custom_fields": {
        //                 "fullname": "coffee",
        //                 "phone": "42",

        //             }
        //         }
        //     ]
        // }');
        $request_body = [
            "contacts" => [
                [
                    "email" => $data["email"],
                    "phone_number" => $data["phone"],
                    "unique_name"=> $data["fullname"],
                    // "custom_fields" => [
                    //     "fullname" => $data["fullname"],

                    // ]
                ]
            ]
        ];

        try {
            $response = $sg->client->marketing()->contacts()->put($request_body);
            // $response = $sg->client->marketing()->contacts()->put()
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
        } catch (\Exception $ex) {
            // throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Get undocumented variable
     *
     * @return  Sendgrid
     */
    public function getSendgridClient()
    {
        return $this->sendgridClient;
    }

    /**
     * Set undocumented variable
     *
     * @param  Sendgrid  $sendgridClient  Undocumented variable
     *
     * @return  self
     */
    public function setSendgridClient(Sendgrid $sendgridClient)
    {
        $this->sendgridClient = $sendgridClient;

        return $this;
    }

    /**
     * Get twillio Configuration File
     *
     * @return  array
     */
    public function getTwilioConfig()
    {
        return $this->twilioConfig;
    }

    /**
     * Set twillio Configuration File
     *
     * @param  array  $twilioConfig  Twillio Configuration File
     *
     * @return  self
     */
    public function setTwilioConfig(array $twilioConfig)
    {
        $this->twilioConfig = $twilioConfig;

        return $this;
    }
}
