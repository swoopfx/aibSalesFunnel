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

    public function indexAction()
    {
        $viewmodel = new ViewModel();
    }

    public function allTravelAction()
    {
        $viewModel = new ViewModel();

        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()
            ->select(["a", "i", "u"])
            ->from(TravelInsurance::class, "a")
            ->leftJoin("a.invoice", "i")
            ->leftJoin("a.user", "u")
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
