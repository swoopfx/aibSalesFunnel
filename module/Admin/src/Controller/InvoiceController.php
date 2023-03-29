<?php

namespace Admin\Controller;

use Application\Entity\Invoice;
use Application\Entity\Transaction;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\JsonModel;

class InvoiceController extends AbstractActionController
{



    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
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
        $viewModel = new ViewModel();
        return $viewModel;
    }


    public function viewallAction()
    {
        $viewModel = new ViewModel();
        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()
            ->select(["a", "s", "u"])
            ->from(Invoice::class, "a")
            ->leftJoin("a.user", "u")
            ->leftJoin("a.status", "s")
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

    public function customerInvoiceAction()
    {
        $em = $this->entityManager;
        $viewModel = new ViewModel();
        $id = $this->params()->fromRoute("id", NULL);
        try {
            $data = $em->createQueryBuilder()->select(["i", "u", "s"])
                ->from(Invoice::class, "i")
                ->leftJoin("i.user", "u")
                ->leftJoin("i.status", "s")
                ->where("u.uuid = :uid")
                ->andWhere("i.isOpen = :open")
                ->setParameters([
                    "uid" => $id,
                    "open" => TRUE,
                ])
                ->orderBy("i.updatedOn", "DESC")
                ->setMaxResults(100)
                ->getQuery()
                ->getResult(Query::HYDRATE_ARRAY);

            $viewModel->setVariables([
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $viewModel;
    }


    public function invoiceTransactionsAction()
    {
        $viewModel = new ViewModel();
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            return $this->redirect()->toRoute("admin");
        } else {
            $data = $this->entityManager->getRepository(Transaction::class)->findBy([
                "invoiceUuid" => $id
            ]);

            $viewModel->setVariables([
                "data" => $data,
            ]);
        }
        return $viewModel;
    }



    public function cancelInvoiceAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $invoiceUUid = $post["uuid"];
            if ($invoiceUUid != null) {
                $invoiceEntity = $this->entityManager->getRepository(Invoice::class)->findOneBy([
                    "invoiceUuid" => $invoiceUUid
                ]);
                // if()
            }
        }
        return $jsonModel;
    }





    public function viewAction()
    {
        $viewModel = new ViewModel();
        $id = $this->params()->fromRoute("id");
        if ($id == NULL) {
            return $this->redirect()->toRoute("admin");
        } else {
            $data = $this->entityManager->getRepository(Invoice::class)->findOneBy([
                "invoiceUuid" => $id
            ]);
            $viewModel->setVariables([
                "data" => $data
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
