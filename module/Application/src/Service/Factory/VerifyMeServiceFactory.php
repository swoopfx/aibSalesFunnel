<?php

namespace Application\Service\Factory;

use Application\Entity\Settings;
use Application\Service\VerifyMeService;
use Laminas\Http\Client;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class VerifyMeServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new VerifyMeService();
        // try {
        $generalService = $container->get("general_service");
        $em = $generalService->getEm();
        /**
         * @var Settings
         */
        $settings = $generalService->getSettings();
        $qoreIdInstance = new Client("https://api.qoreid.com/token");
        $qoreIdInstance->setMethod("POST");
        $clientId = $settings->getQoreIdClientId();
        $secretKey = $settings->getQoreIdSecretKey();
        $header["Content-Type"] = "application/json";
        $header["Accept"] = "text/plain";
        $data = [
            "clientId" => $clientId,
            "secret" => $secretKey,
        ];
        $qoreIdInstance->setRawBody(json_encode($data));
        $res = $qoreIdInstance->send();
        if ($res->isSuccess()) {
            $qorePayload = json_decode($res->getBody());
            $xserv->setEntityManager($em)->setGeneralService($generalService)->setSettings($settings)->setQoreIdPayload($qorePayload);
        } else {
            throw new \Exception("Could not retrieve Qore ID Token");
        }

        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        return $xserv;
    }
}
