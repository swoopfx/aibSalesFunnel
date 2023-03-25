<?php

namespace Application\Service\Factory;

use Application\Service\UploadService;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class UploadServiceFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $appConfig = $container->get("config");
        $awsCredentials = $appConfig["aws"]["credentials"];
        $awsCred = new Credentials($awsCredentials["key"], $awsCredentials["secret"]);
        // print_r($awsCredentials["key"]);
        // var_dump($awsCredentials["secret"]);
        $generalService = $container->get("general_service");
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => $awsCred
        ]);
        $xserv = new UploadService();
        $xserv->setS3Instance($s3)->setEntityManager($generalService->getEm());
        return $xserv;
    }
}