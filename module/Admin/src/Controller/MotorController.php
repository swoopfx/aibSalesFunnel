<?php

namespace Admin\Controller;

use Application\Entity\MotorInsurance;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class MotorController extends AbstractActionController
{

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }


    public function allMotorAction()
    {
        $viewModel = new ViewModel();
        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()
            ->select(["a", "i", "u"])
            ->from(MotorInsurance::class, "a")
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



    public function viewMotorAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }



    public function editMotorAction()
    {
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
