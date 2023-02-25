<?php

namespace Application\Form;

use Laminas\InputFilter\InputFilter;
use DoctrineModule\Validator\NoObjectExists;
use Doctrine\ORM\EntityManager;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\Identical;
use Laminas\Validator\StringLength;

class RegisterInputFilter extends InputFilter
{

    private $entityManager;


    public function __construct()
    {

        $this->add(array(
            'name' => 'phonenumber',
            'required' => true,
            "allow_empty" => false,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Identity is required'
                        )
                    )
                ),
                [
                    "name" => NoObjectExists::class,
                    "options" => [
                        "use_context" => true,
                        "object_repository" => $this->entityManager->getRepository(User::class),
                        "objject_manager" => $this->entityManager,
                        "fields" => [
                            "username"
                        ],
                        "messages" => [
                            NoObjectExists::ERROR_NO_OBJECT_FOUND => "please use another Phone number"
                        ]
                    ]
                ],
                [
                    'name' => StringLength::class,
                    'options' => array(
                        'messages' => array(),
                        'min' => 10,
                        'max' => 11,
                        'messages' => array(
                            StringLength::TOO_SHORT => 'Please provide a valid number',
                            StringLength::TOO_LONG => 'We think this is not a valid Phone Number'
                        )
                    ),
                ]
            )
        ));


        $this->add(array(
            'name' => 'fullname',
            'required' => true,
            "allow_empty" => false,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'What do we call you, we need to know'
                        )
                    )
                ),

                [
                    'name' => StringLength::class,
                    'options' => array(
                        'messages' => array(),
                        'min' => 2,
                        'max' => 256,
                        'messages' => array(
                            StringLength::TOO_SHORT => 'We dont think you are Chinese',
                            StringLength::TOO_LONG => 'How to you refer to such long name'
                        )
                    ),
                ]
            )
        ));


        $this->add([
            'email' => array(
                'required' => true,
                'allow_empty' => false,
                'break_chain_on_failure' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    // array(
                    // 'name' => 'Regex',
                    // 'options' => array(
                    // 'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
                    // 'messages' => array(
                    // Regex::NOT_MATCH => 'Please provide a valid email address.'
                    // )
                    // ),
                    // 'break_chain_on_failure' => true
                    // ),
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'use_context' => true,
                            'object_repository' => $this->entityManager->getRepository(User::class),
                            'object_manager' => $this->entityManager,
                            'fields' => array(
                                'email'
                            ),
                            'messages' => array(

                                NoObjectExists::ERROR_OBJECT_FOUND => 'Someone else is registered with this email'
                            )
                        )
                    ),
                    array(
                        'name' => 'Laminas\Validator\StringLength',
                        'options' => array(
                            'messages' => array(),
                            'min' => 3,
                            'max' => 256,
                            'messages' => array(
                                StringLength::TOO_SHORT => 'Email Too short',
                                StringLength::TOO_LONG => 'We dont think this is a genuine email'
                            )
                        ),


                    ),
                    array(
                        'name' => 'EmailAddress',

                        'options' => array(

                            'messages' => array(
                                EmailAddress::INVALID_FORMAT => 'Please check your email something is not right'
                            )
                        )
                    )

                )
            )
        ]);



        $this->add([
            "emailVerify" => array(
                "required" => true,
                "allow_empty" => false,
                "validators" => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 6,
                            'max' => 50,
                            "messages" => array(
                                StringLength::TOO_SHORT => "The email must be more than 6 characters",
                                StringLength::TOO_LONG => "This email is too long to memorize"
                            )
                        )
                    ),
                    array(
                        'name' => 'EmailAddress',

                        'options' => array(

                            'messages' => array(
                                EmailAddress::INVALID_FORMAT => 'Please check your email something is not right'
                            )
                        )
                    ),
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'email',
                            "messages" => array(
                                Identical::NOT_SAME => "The email are not identical"
                            )
                        )
                    )
                )
            )
        ]);
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
