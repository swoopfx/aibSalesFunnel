<?php

namespace Application\Service\Factory;

use Application\Entity\Settings;
use Application\Service\PaystackService;
use Application\Service\TransactionService;
use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class PaystackServiceFactory implements FactoryInterface
{


    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $xserv = new PaystackService();
        $generalService = $container->get("general_service");
        $transactionService = $container->get(TransactionService::class);
        $em = $generalService->getEm();
        $details = $this->getPaystackDetails($em);
        // var_dump($details);
        $xserv->setPaystackDetails($details)->setTransactionService($transactionService)->setGeneralService($generalService);
        return $xserv;
    }

    private function getPaystackDetails(EntityManager $em)
    {
        return  $em->getRepository(Settings::class)
            ->createQueryBuilder("a")
            ->select("a.paystackKey, a.paystackSecret")->where("a.id=1")->getQuery()
            ->getArrayResult();
    }
}
