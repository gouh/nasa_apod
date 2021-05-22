<?php


namespace App\InputFilter;

use Laminas\Filter\HtmlEntities;
use Laminas\Filter\StringTrim;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Date;
use Laminas\Validator\StringLength;
use Laminas\Validator\Uri;

class ApodInputFilter extends InputFilter
{
    public function init()
    {
        // Date
        $this->add(
            [
                'name' => 'date',
                'required' => true,
                'allow_empty' => false,
                'validators' => [
                    [
                        'name' => Date::class
                    ],
                ],
                'error_message' => "'date' is required with format Y-m-d."
            ],
        );

        // Explaniation
        $this->add(
            [
                'name' => 'explanation',
                'required' => true,
                'allow_empty' => false,
                'filters' => [
                    [
                        'name' => HtmlEntities::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'error_message' => "'explanation' is required."
            ]
        );

        // Hdurl
        $this->add(
            [
                'name' => 'hdurl',
                'required' => true,
                'allow_empty' => false,
                'validators' => [
                    [
                        'name' => Uri::class
                    ],
                ],
                'error_message' => "'hdurl' is required and valid uri."
            ]
        );

        // MediaType
        $this->add(
            [
                'name' => 'media_type',
                'required' => true,
                'allow_empty' => false,
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'max' => 20
                        ]
                    ]
                ],
                'filters' => [
                    [
                        'name' => HtmlEntities::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'error_message' => "'media_type' is required and with max-length 20 characteres."
            ]
        );

        // service version
        $this->add(
            [
                'name' => 'service_version',
                'required' => true,
                'allow_empty' => false,
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'max' => 5
                        ]
                    ]
                ],
                'filters' => [
                    [
                        'name' => HtmlEntities::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'error_message' => "'media_type' is required and with max-length 5 characteres."
            ]
        );

        // service version
        $this->add(
            [
                'name' => 'title',
                'required' => true,
                'allow_empty' => false,
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'max' => 150
                        ]
                    ]
                ],
                'filters' => [
                    [
                        'name' => HtmlEntities::class,
                    ],
                    [
                        'name' => StringTrim::class,
                    ],
                ],
                'error_message' => "'media_type' is required and with max-length 150 characteres."
            ]
        );


        // url
        $this->add(
            [
                'name' => 'url',
                'required' => true,
                'allow_empty' => false,
                'validators' => [
                    [
                        'name' => Uri::class
                    ],
                ],
                'error_message' => "'url' is required and valid uri."
            ]
        );
    }
}
