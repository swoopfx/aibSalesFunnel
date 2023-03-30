<?php

namespace Admin\Controller;

use Application\Entity\MarineCargoInsurance;
use Application\Entity\MotorInsurance;
use Application\Entity\TravelInsurance;
use Application\Entity\User;
use Application\Service\UserService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\View\Model\JsonModel;

class AdminController extends AbstractActionController
{





    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    public function allCustomersAction()
    {
        $viewModel = new ViewModel();
        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()->select(["a", "r"])
            ->from(User::class, "a")
            ->leftJoin("a.role", "r")
            ->where("a.isActive = :active")
            ->andWhere("a.role = :role")
            ->setParameters([
                "active" => TRUE,
                "role" => UserService::USER_ROLE_CUSTOMER
            ])
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

    public function recentMotorAction()
    {
        $jsonModel = new JsonModel();
        $dateObject = new \Datetime();
        $dateObject->modify("-24 hour");

        $data = $this->entityManager->createQueryBuilder()
            ->select(["a"])
            ->from(MotorInsurance::class, "a")
            ->where("a.createdOn > :date")
            ->andWhere("a.isActive = :active")
            ->setParameters([
                "date" => $dateObject,
                "active" => TRUE
            ])->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $jsonModel->setVariables([
            "data" => $data
        ]);
        return $jsonModel;
    }

    public function recentTravelAction()
    {
        $jsonModel = new JsonModel();
        $dateObject = new \Datetime();
        $dateObject->modify("-24 hour");

        $data = $this->entityManager->createQueryBuilder()
            ->select(["a"])
            ->from(TravelInsurance::class, "a")
            ->where("a.createdOn > :date")
            ->setParameters([
                "date" => $dateObject
            ])->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $jsonModel->setVariables([
            "data" => $data
        ]);
        return $jsonModel;
    }


    public function recentCargoAction()
    {
        $jsonModel = new JsonModel();
        $dateObject = new \Datetime();
        $dateObject->modify("-24 hour");

        $data = $this->entityManager->createQueryBuilder()
            ->select(["a"])
            ->from(MarineCargoInsurance::class, "a")
            ->where("a.createdOn > :date")
            ->andWhere("a.isActive = :active")
            ->setParameters([
                "date" => $dateObject,
                "active" => TRUE
            ])->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $jsonModel->setVariables([
            "data" => $data
        ]);
        return $jsonModel;
    }

    public function recentCustomersAction()
    {
        $jsonModel = new JsonModel();
        $dateObject = new \Datetime();
        $dateObject->modify("-24 hour");

        $data = $this->entityManager->createQueryBuilder()
            ->select(["a"])
            ->from(User::class, "a")
            ->where("a.createdOn > :date")
            ->andWhere("a.role = :role")
            ->setParameters([
                "date" => $dateObject,
                "role" => UserService::USER_ROLE_CUSTOMER
            ])->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $jsonModel->setVariables([
            "data" => $data
        ]);
        return $jsonModel;
    }


    public function recentSalesAction(){
        $jsonModel = new JsonModel();
    }


    public function recentSupportAction()
    {
    }



    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        $this->redirectPlugin()->redirectToLogout();
        $this->layout()->setTemplate('layout/admin');
        return $response;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function viewerAction()
    {
        $viewModel = new ViewModel();
        $image  = $this->params()->fromRoute("id", NULL);
        $viewModel->setVariables([
            "data" => $image
        ]);
        return $viewModel;
    }


    public function disableUserAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function enableUserAction()
    {
        $jsonModel = new JsonModel();
        return $jsonModel;
    }


    public function editUserAction()
    {
    }


    public function loginAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate("layout/admin-login");
        return $viewModel;
    }


    public function loginjsonAction()
    {
        $jsonModel = new JsonModel();

        return $jsonModel;
    }


    public function createAction()
    {
        $viewModel = new ViewModel();
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
