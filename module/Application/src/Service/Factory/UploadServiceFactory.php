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
        $awsCredentials = new Credentials($awsCredentials["key"], $awsCredentials["secret"]);
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-west-2',
            'credentials' => false
        ]);
        $xserv = new UploadService();
    }
}