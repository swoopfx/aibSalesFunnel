<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="travel_insurance")
 */

class TravelInsurance
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     *
     * @var User
     */
    private $user;

    /**
     * String
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $travelUid;


    /**
     * Date of birth
     * @ORM\Column(type="date", nullable=true)
     * @var \Date
     */
    private $dob;

    /**
     * 
     *
     * @var [
     */
    private $destination;

    /**
     * Which is also departure 
     *
     * @var \Datetime
     */
    private $startDate;

    /**
     * Expiry Date
     *
     * @var  \Datetime
     */
    private $expireDate;

    /**
     * Undocumented variable
     *
     * @var Collection
     */
    private $travelList;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $updatedOn;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \Datetime
     */
    private $createdOn;


    public function __construct()
    {
        $this->travelList = new ArrayCollection();
    }

    /**
     * Get the value of user
     *
     * @return  User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */ 
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get string
     *
     * @return  string
     */ 
    public function getTravelUid()
    {
        return $this->travelUid;
    }

    /**
     * Set string
     *
     * @param  string  $travelUid  String
     *
     * @return  self
     */ 
    public function setTravelUid(string $travelUid)
    {
        $this->travelUid = $travelUid;

        return $this;
    } 

    /**
     * Get date of birth
     *
     * @return  \Date
     */ 
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set date of birth
     *
     * @param  \Date  $dob  Date of birth
     *
     * @return  self
     */ 
    public function setDob( $dob)
    {
        $this->dob = $dob;

        return $this;
    }
}
