<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="transaction")
 */

class Transaction {


      /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Trabsaction Reference
     * @ORM\Column(type="string", nullable=false, unique=true)
     *
     * @var string
     */
    private $transactionRef;

    /**
     * 
     * @ORM\Column(type="string", nullable=false, unique=true)
     *
     * @var  string
     */
    private $transactionUid;
}