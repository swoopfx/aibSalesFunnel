<?php

 namespace Application\Service;

 use Doctrine\ORM\EntityManager;
 use Aws\S3\S3Client;

 class UploadService {

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Undocumented variable
     *
     * @var S3Client
     */
    private $s3Instance;

    public function upload($file){

    }

   //  private function 

    /**
     * Get the value of s3Instance
     */ 
    public function getS3Instance()
    {
        return $this->s3Instance;
    }

    /**
     * Set the value of s3Instance
     *
     * @return  self
     */ 
    public function setS3Instance($s3Instance)
    {
        $this->s3Instance = $s3Instance;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  EntityManager
     */ 
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set undocumented variable
     *
     * @param  EntityManager  $entityManager  Undocumented variable
     *
     * @return  self
     */ 
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
 }