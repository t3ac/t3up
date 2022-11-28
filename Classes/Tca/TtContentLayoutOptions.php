<?php
declare(strict_types=1);
namespace T3ac\T3up\Tca;


/**
 * Class TtContentLayoutOptions
 * to show field options of tt_content.layout and .frame_class when some conditions are fitting
 */
class TtContentLayoutOptions
{
    /**
     * @var array
     */
    protected $mapping = [
        

        'frame_class' => [
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'div'
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:thin',
                        'thin'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:medium',
                        'medium'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:thick',
                        'thick'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                ]
            ],
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'header'
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                ]
            ],
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'shortcut'
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:none',
                        'none'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                        'white'
                    ]
                ]
            ],
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'table'
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                        'white'
                    ],
                ]
            ],
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'text'
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                        'white'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:line',
                        'line'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:colored',
                        'colored'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:2columns',
                        '2columns'
                    ],
                ]
            ],
                  
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'textmedia'
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                        'white'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:line',
                        'line'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:colored',
                        'colored'
                    ],
                ]
            ],
                              
            /* Extensions */            
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'list'
                        ],
                        'list_type' => [
                            'hdapersonen_hdapersonen'
                        ],
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:contact',
                        'contact'
                    ],
                ]
            ],

            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'list'
                        ],
                        'list_type' => [
                            'news_pi1'
                        ],
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:none',
                        'none'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                        'white'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:line',
                        'line'
                    ],
                ]
            ],
            
            
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'youtubevideo_pi1'
                        ],
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                        'default'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:none',
                        'none'
                    ],
                ]
            ],
            
            
            

            /**** CONTAINER  **********************************************************************************/

                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '1cols'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:none',
                            'none'
                        ],
                    ]
                ],
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '2cols'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                            'white'
                        ],
                    ]
                ],
                
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '3cols'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                            'white'
                        ],
                    ]
                ],
                
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '4cols'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                            'white'
                        ],
                    ]
                ],
                
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                'tabs'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:white',
                            'white'
                        ],
                    ]
                ],
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '2tabs'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                    ]
                ],
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '3tabs'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                    ]
                ],
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                '4tabs'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                    ]
                ],
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                'accordion'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                    ]
                ],
                [
                    'conditions' => [
                        'fields' => [
                            'CType' => [
                                'slide'
                            ]
                        ],
                    ],
                    'options' => [
                        [
                            'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:default',
                            'default'
                        ],
                    ]
                ],
    
            
    /**** ONEPAGER  **********************************************************************************/
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'text'
                        ],
                        'container' => [
                            '1',
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:grey',
                        'grey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightgrey',
                        'lightgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:darkgrey',
                        'darkgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:black',
                        'black'
                    ],
                ]
            ],
            
            
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            'textmedia'
                        ],
                        'container' => [
                            '1',
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:grey',
                        'grey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightgrey',
                        'lightgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:darkgrey',
                        'darkgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:black',
                        'black'
                    ],
                ]
            ],
            
            
            /* Container */
        
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            '2cols'
                        ],
                        'container' => [
                            '1',
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:grey',
                        'grey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightgrey',
                        'lightgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:darkgrey',
                        'darkgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:black',
                        'black'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:colored',
                        'colored'
                    ],
                ]
            ],
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            '3cols'
                        ],
                        'container' => [
                            '1',
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:grey',
                        'grey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightgrey',
                        'lightgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:darkgrey',
                        'darkgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:black',
                        'black'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:colored',
                        'colored'
                    ],
                ]
            ],
        
            [
                'conditions' => [
                    'fields' => [
                        'CType' => [
                            '4cols'
                        ],
                        'container' => [
                            '1',
                        ]
                    ],
                ],
                'options' => [
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:grey',
                        'grey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightgrey',
                        'lightgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:darkgrey',
                        'darkgrey'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:black',
                        'black'
                    ],
                    [
                        'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:colored',
                        'colored'
                    ],
                ]
            ],
    
    
    
    
        ]
    ];
    
    /**
     * Values of tt_content.*
     *
     * @var array
     */
    protected $properties = [];
    
    /**
     * Options like
     *  [
     *      [
     *          'label 1',
     *          'value 1'
     *      ],
     *      [
     *          'label 2',
     *          'value 2'
     *      ]
     *  ]
     *
     * @var array
     */
    protected $items = [];
    
    /**
     * Current field where userFunc was added (e.g. "layout" or "frame_class")
     *
     * @var string
     */
    protected $field = '';
    
    /**
     * @param array $params
     * @return void
     */
    protected function initialize(array &$params): void
    {
        $this->properties = $params['row'];
        if (is_array($this->properties['CType'])) {
            $this->properties['CType'] = $this->properties['CType'][0];
        }
        if (is_array($this->properties['layout'])) {
            $this->properties['layout'] = $this->properties['layout'][0];
        }
        if (is_array($this->properties['frame_class'])) {
            $this->properties['frame_class'] = $this->properties['frame_class'][0];
        }
        $this->items = &$params['items'];
        $this->items = [];
        $this->field = $params['field'];
    }
    
    /**
     * @param array $params
     * @return void
     */
    public function addOptions(array &$params): void
    {
        $this->initialize($params);
        $this->setOptions();
    }
    
    /**
     * @return void
     */
    protected function setOptions(): void
    {
        foreach ($this->mapping[$this->field] as $configuration) {
            if ($this->isConditionMatching($configuration['conditions'])) {
                $this->items = array_merge($this->items, $configuration['options']);
            }
        }
    }
    
    /**
     * @param array $conditions
     * @return bool
     */
    protected function isConditionMatching(array $conditions): bool
    {
        if (isset($conditions['fields'])) {
            foreach ($conditions['fields'] as $startField => $compareFields) {
                if (in_array($this->properties[$startField], $compareFields) === false) {
                    return false;
                }
            }
        }
        if (isset($conditions['functions'])) {
            foreach ($conditions['functions'] as $function) {
                if ($this->{$function}() === false) {
                    return false;
                }
            }
        }
        return true;
    }

}