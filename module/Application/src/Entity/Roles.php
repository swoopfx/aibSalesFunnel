<?php


namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Roles {
      /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(nullable=false)
     */
    protected $name;


    /**
     * @var Array
     * 
     * @ORM\ManyToMany(targetEntity="Roles", cascade={"persist"})
     * @ORM\JoinTable(name="roles_parents",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id")}
     *      )
     */
    protected $parents;


    public function __construct()
    {
        $this->parents = new ArrayCollection();
    }


    public function getId(){
        return $this->id;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    

    /**
     * Get the value of parents
     *
     * @return  Array
     */ 
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * Set the value of parents
     *
     * @param  Array  $parents
     *
     * @return  self
     */ 
    public function setParents(Array $parents)
    {
        $this->parents = $parents;

        return $this;
    }
}

