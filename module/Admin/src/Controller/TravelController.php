<?php

namespace Admin\Controller;

use Application\Entity\TravelInsurance;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class TravelController extends AbstractActionController
{

    private $entityManager;

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->redirectPlugin()->redirectToLogout();
        $this->layout()->setTemplate('layout/admin');
        return $response;
    }

    public function indexAction()
    {
        $viewmodel = new ViewModel();
        return $viewmodel;
    }

    public function allTravelAction()
    {
        $viewModel = new ViewModel();

        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()
            ->select(["a", "i", "u", "d", "s", "li"])
            ->from(TravelInsurance::class, "a")
            ->leftJoin("a.invoice", "i")
            ->leftJoin("a.destination", "d")
            ->leftJoin("a.user", "u")
            ->leftJoin("i.status", "s")
            ->leftJoin("a.travelList", "li")
            ->orderBy("a.id", "DESC")
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY);
        $paginator = new Paginator($query);
        $totalItems = count($paginator);
        $params = $this->params()->fromQuery("page", null);
        $currentpage = $params ?: 1;
        $totalPageCount = ceil($totalItems / ($pageCount ?: 50));
        $nextPage = ($currentpage < $totalPageCount) ? $currentpage + 1 : $totalPageCount;
        $previousPage = (($currentpage > 1) ? $currentpage - 1 : 1);

        $records = $paginator->getQuery()->setFirstResult($pageCount * ($currentpage - 1))->setMaxResults($pageCount)->getResult(Query::HYDRATE_ARRAY);
        $viewModel->setVariables([
            "previous_page" => $previousPage,
            "next_page" => $nextPage,
            "data" => $records
        ]);
        return $viewModel;
    }


    public function customerTravelAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function viewAction()
    {
        $viewModel = new ViewModel();
        $em = $this->entityManager;
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            return $this->redirect()->toRoute("admin");
        } else {
            $data = $em->createQueryBuilder()->select(["a", "i", "u", "t", "v", "s"])
                ->from(TravelInsurance::class, "a")
                ->leftJoin("a.invoice", "i")
                ->leftJoin("a.user", "u")
                ->leftJoin("a.destination", "t")
                ->leftJoin("a.nationality", "v")
                ->leftJoin("i.status", "s")
                ->where("a.travelUuid = :uuid")
                ->setParameters([
                    "uuid" => $id,
                ])
                ->getQuery()
                ->setHydrationMode(Query::HYDRATE_ARRAY)
                ->getArrayResult();

            $viewModel->setVariables([
                "data" => $data[0]
            ]);
        }
        return $viewModel;
    }

    /**
     * Get the value of entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
