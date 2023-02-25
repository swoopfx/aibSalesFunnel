<?php


namespace Application\Form;

use Laminas\InputFilter\InputFilter;

class LoginInputFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'phoneOrEmail',
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


            )
        ));
    }
}
