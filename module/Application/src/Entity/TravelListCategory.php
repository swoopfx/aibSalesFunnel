<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="travel_list_category")
 * 
 */


class  TravelListCategory
{


    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Adult
     * @ORM\Column(nullable=false)
     * @var string
     */
    private $category;


    public function getId()
    {
        return $this->id;
    }

    /**
     * Get adult
     *
     * @return  string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set adult
     *
     * @param  string  $category  Adult
     *
     * @return  self
     */
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }
}
