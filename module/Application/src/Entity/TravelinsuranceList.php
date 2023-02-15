<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="travel_insurance_list")
 */

class TravelinsuranceList {


     /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    private $categroy;

    private $surname;

    private $firstname;

    private $passport;

    private $gender;

    private $dob;

    private $createdOn;

    private $updatedOn;
}