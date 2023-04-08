<?php

namespace Application\Service;

use Laminas\Http\Client;
use stdClass;

class MailtrapService
{


    private $mailtrapconfig;

    public function passwordResetMail($data)
    {
        try {

            $config = $this->mailtrapconfig;
            // var_dump($config["url"]);
            // $header["Authorization"] = "Bearer {$config['token']}";
            // $header['Content-Type'] = 'application/json';
            // $client = new Client();


            // $client->setMethod("POST");
            // $from = new stdClass();
            // $to = new stdClass();
            // $fromObject = new stdClass();
            // $fromObject->email = "mailtrap@aibltd.insure"; //$data["fromEmail"];
            // $template_uid = new stdClass();
            // $fromObject->name = GeneralService::COMPANY_NAME;
            // $toObj = new stdClass();
            // $toObj->email = $data["to"];
            // $from->from = $fromObject;
            // $to->to = [
            //     // $data["to"]
            //     $toObj

            // ];
            // $template_uid->template_uuid = "17608483-803f-4acc-842d-d340bf1c2cff";
            // $template_variables = new stdClass();
            // $template_variables->user_email = $data["to"];
            // $template_variables->pass_reset_link = $data['fulllink'];
            // $dataParam
            $param = [
                // $from,
                // $to,
                // $template_uid,
                // $template_variables
                "from" => [
                    "email" => "no-reply@aibltd.insure",
                    "name" => "Advocate Insurance Brokers",
                ],
                "to" => [
                    ["email" => $data["to"]]
                ],
                "template_uuid" => "17608483-803f-4acc-842d-d340bf1c2cff",
                "template_variables" => [
                    "user_email" => $data["to"],
                    "pass_reset_link" => $data['fulllink']
                ]

            ];
            // $client->setRawBody(json_encode($param));
            // $client->setUri("https://send.api.mailtrap.io/api/send");
            // $client->setHeaders($header);
            // $client->send();

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://send.api.mailtrap.io/api/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($param), //'{"from":{"email":"no-reply@aibltd.insure","name":"Advocate Insurance Brokers"},"to":[{"email":"ezekiel_a@yahoo.com"}],"template_uuid":"17608483-803f-4acc-842d-d340bf1c2cff","template_variables":{"user_email":"Test_User_email","pass_reset_link":"Test_Pass_reset_link"}}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 8c74bd5ea48c5f3f7662a22be746915d',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    /**
     * Get the value of mailtrapconfig
     */
    public function getMailtrapconfig()
    {
        return $this->mailtrapconfig;
    }

    /**
     * Set the value of mailtrapconfig
     *
     * @return  self
     */
    public function setMailtrapconfig($mailtrapconfig)
    {
        $this->mailtrapconfig = $mailtrapconfig;

        return $this;
    }
}
