<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="marine_cargo_insurance")
 */
class MarineCargoInsurance
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(nullable=false)
     *
     * @var string
     */
    private $cargoUid;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     *
     * @var User
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $createdOn;

     /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $updatedOn;
}
