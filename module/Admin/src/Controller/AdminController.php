<?php

namespace Admin\Controller;

use Application\Entity\User;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AdminController extends AbstractActionController
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $entityManager;

    public function getAllCustomerAction()
    {
        $viewModel = new ViewModel();
        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()->select(["a"])->from(User::class, "a")->orderBy("a.id", "DESC")->getQuery()->setHydrationMode(Query::HYDRATE_ARRAY);
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
