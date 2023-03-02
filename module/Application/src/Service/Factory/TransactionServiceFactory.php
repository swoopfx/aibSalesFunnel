<?php 

namespace Application\Service\Factory;

use Application\Service\TransactionService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TransactionServiceFactory implements FactoryInterface {


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new TransactionService();
        $generalService = $container->get("general_service");
        $xserv->setEntityManager($generalService->getEm());
        return $xserv;
    }
}