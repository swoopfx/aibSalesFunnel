<?php

namespace Application\Entity;


class User {

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Undocumented variable
     *
     * @ORM\Column(nullable=true)
     * @var string
     */
    private $fullname;

    /**
     * @ORM\Column(length=30, nullable=false, unique=true)
     */
    protected $phonenumber;


    /**
     * @ORM\Column(length=30, nullable=false, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="password", length=100, nullable=false)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Authentication\Entity\Roles")
     * 
     * @var Roles
     */
    private $role;

    
}