<?php

namespace Admin\Controller;

use Application\Entity\MotorInsurance;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\JsonModel;

class MotorController extends AbstractActionController
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


    public function allMotorAction()
    {
        $viewModel = new ViewModel();
        $pageCount = 100;
        $query = $this->entityManager->createQueryBuilder()
            ->select(["a", "i", "u", "t", "s"])
            ->from(MotorInsurance::class, "a")
            ->leftJoin("a.invoice", "i")
            ->leftJoin("a.user", "u")
            ->leftJoin("a.coverType", "t")
            ->leftJoin("i.status", "s")
            ->where("a.isActive = :active")
            ->setParameters([
                "active" => TRUE
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


    public function customerMotorAction()
    {
        $viewModel = new ViewModel();
        $id = $this->params()->fromRoute("id", NULL);
        if ($id == NULL) {
            return $this->redirect()->toRoute("admin");
        } else {
            $em = $this->entityManager;
            $data = $em->createQueryBuilder()->select(["a", "i", "u", "t", "m", "s"])
                ->from(MotorInsurance::class, "a")
                ->leftJoin("a.invoice", "i")
                ->leftJoin("a.user", "u")
                ->leftJoin("a.coverType", "t")
                ->leftJoin("a.meansOfId", "m")
                ->leftJoin("i.status", "s")
                ->where("a.isActive = :active")
                ->andWhere("u.uuid = :useruuid")
                ->setParameters([
                    "active" => TRUE,
                    "useruuid" => $id,
                ])
                ->orderBy("a.id", "DESC")
                ->setMaxResults(100)
                ->getQuery()
                ->setHydrationMode(Query::HYDRATE_ARRAY)
                ->getArrayResult();

            // print_r($data);
            $viewModel->setVariables([
                "data" => $data
            ]);
        }
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
            $data = $em->createQueryBuilder()->select(["a", "i", "u", "t", "v", "p", "s"])
                ->from(MotorInsurance::class, "a")
                ->leftJoin("a.invoice", "i")
                ->leftJoin("a.user", "u")
                ->leftJoin("a.coverType", "t")
                ->leftJoin("a.vehicleLicense", "v")
                ->leftJoin("a.proofOfOwnership", "p")
                ->leftJoin("i.status", "s")
                ->where("a.uid = :uuid")
                ->setParameters([

                    "uuid" => $id,
                ])
                // ->orderBy("a.id", "DESC")
                // ->setMaxResults(100)
                ->getQuery()
                ->setHydrationMode(Query::HYDRATE_ARRAY)
                ->getArrayResult();



            
            $viewModel->setVariables([
                "data" => $data[0]
            ]);
        }
        return $viewModel;
    }





    public function editMotorAction()
    {
    }



    public function revokeAction()
    {
        $jsonModel = new JsonModel();
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post = $request->getPost();
            $uuid = $post["uuid"];
            $em = $this->entityManager;
            try {
                /**
                 * @var MotorInsurance
                 */
                $motorEntity = $em->getRepository(MotorInsurance::class)->findOneBy([
                    "uuid" => $uuid
                ]);
                if ($uuid != NULL) {
                    $motorEntity->setIsActive(FALSE)->setUpdatedOn(new \Datetime());

                    $em->persist($motorEntity);
                    $em->flush();


                    $jsonModel->setVariables([]);
                    $response->setStatusCode(201);
                } else {
                    $response->setStatusCode(400);
                    $jsonModel->setVariables([
                        "messages" => "Motor Data does not exist"
                    ]);
                }
            } catch (\Throwable $th) {
                $response->setStatusCode(400);
                $jsonModel->setVariables([
                    "messages" => $th->getMessage()
                ]);
            }
        }
        return $jsonModel;
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
