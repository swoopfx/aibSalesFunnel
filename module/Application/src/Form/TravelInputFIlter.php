<?php

namespace Application\Form;

use Laminas\InputFilter\InputFilter;

class TravelInputFIlter extends InputFilter
{

    public function __construct()
    {
        $this->add([
            "name" => "dob",
            'required' => true,
            "allow_empty" => false,
            "filters" => [
                [
                    'name' => 'StripTags'
                ],
                [
                    'name' => 'StringTrim'
                ]
            ],
            'validators' => [
                [
                    "name" => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            'isEmpty' => 'Please provide a your phone number or email'
                        ]
                    ]

                ]
            ]
        ]);

        $this->add([
            "name" => "destination",
            'required' => true,
            "allow_empty" => false,
            "filters" => [
                [
                    'name' => 'StripTags'
                ],
                [
                    'name' => 'StringTrim'
                ]
            ],
            'validators' => [
                [
                    "name" => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            'isEmpty' => 'Please provide a your phone number or email'
                        ]
                    ]

                ]
            ]
        ]);


        $this->add([
            "name" => "dob",
            'required' => true,
            "allow_empty" => false,
            "filters" => [
                [
                    'name' => 'StripTags'
                ],
                [
                    'name' => 'StringTrim'
                ]
            ],
            'validators' => [
                [
                    "name" => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            'isEmpty' => 'Please provide a your phone number or email'
                        ]
                    ]

                ]
            ]
        ]);



        $this->add([
            "name" => "dob",
            'required' => true,
            "allow_empty" => false,
            "filters" => [
                [
                    'name' => 'StripTags'
                ],
                [
                    'name' => 'StringTrim'
                ]
            ],
            'validators' => [
                [
                    "name" => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            'isEmpty' => 'Please provide a your phone number or email'
                        ]
                    ]

                ]
            ]
        ]);
    }
}
