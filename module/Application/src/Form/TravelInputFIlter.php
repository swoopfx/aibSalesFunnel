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
                            'isEmpty' => 'Destination is required'
                        ]
                    ]

                ]
            ]
        ]);


        $this->add([
            "name" => "departureDate",
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
                            'isEmpty' => 'Departure Date is required'
                        ]
                    ]

                ]
            ]
        ]);


        $this->add([
            "name" => "nationality",
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
                            'isEmpty' => 'Your Nationality is required'
                        ]
                    ]

                ]
            ]
        ]);


        $this->add([
            "name" => "returnDate",
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
                            'isEmpty' => 'Return Date is required'
                        ]
                    ]

                ]
            ]
        ]);



        $this->add([
            "name" => "user",
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
                            'isEmpty' => 'You need to be logged in to process this form'
                        ]
                    ]

                ]
            ]
        ]);

        $this->add([
            "name" => "travelList",
            'required' => false,
            "allow_empty" => true,
            "filters" => [
                [
                    'name' => 'StripTags'
                ],
                [
                    'name' => 'StringTrim'
                ]
            ],

        ]);
    }
}
