<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person 
 * Business
 * @ORM\Entity
 * @ORM\Table(name="user_category")
 */

class UserCategory
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private  $id;


    /**
     * Undocumented variable
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $category;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get undocumented variable
     *
     * @return  string
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $category  Undocumented variable
     *
     * @return  self
     */ 
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }
}
