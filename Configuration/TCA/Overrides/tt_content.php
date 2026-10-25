<?php
defined('TYPO3') or die();

// Sprachdatei
$ll = 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf';

$padding = array(
    'padding_before_class' => [
        'exclude' => true,
        'label'   => $ll . ':padding_before',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':space_class_none', 'value' => '0'],
                ['label' => $ll . ':space_class_1', 'value' =>  '1'],
                ['label' => $ll . ':space_class_2', 'value' =>  '2'],
                ['label' => $ll . ':space_class_3', 'value' =>  '3'],
                ['label' => $ll . ':space_class_4', 'value' =>  '4'],
                ['label' => $ll . ':space_class_5', 'value' =>  '5'],
                ['label' => $ll . ':space_class_6', 'value' =>  '6'],
                ['label' => $ll . ':space_class_7', 'value' =>  '7'],
            ],
            'default'    => '',
        ],
    ],
    'padding_after_class'  => [
        'exclude' => true,
        'label'   => $ll . ':padding_after',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':space_class_none', 'value' => '0'],
                ['label' => $ll . ':space_class_1', 'value' =>  '1'],
                ['label' => $ll . ':space_class_2', 'value' =>  '2'],
                ['label' => $ll . ':space_class_3', 'value' =>  '3'],
                ['label' => $ll . ':space_class_4', 'value' =>  '4'],
                ['label' => $ll . ':space_class_5', 'value' =>  '5'],
                ['label' => $ll . ':space_class_6', 'value' =>  '6'],
                ['label' => $ll . ':space_class_7', 'value' =>  '7'],
            ],
            'default'    => '',
        ],
    ],
    
    'space_before_class' => [
        'exclude' => true,
        'label'   => $ll . ':space_before',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':space_class_none', 'value' => '0'],
                ['label' => $ll . ':space_class_1', 'value' =>  '1'],
                ['label' => $ll . ':space_class_2', 'value' =>  '2'],
                ['label' => $ll . ':space_class_3', 'value' =>  '3'],
                ['label' => $ll . ':space_class_4', 'value' =>  '4'],
                ['label' => $ll . ':space_class_5', 'value' =>  '5'],
                ['label' => $ll . ':space_class_6', 'value' =>  '6'],
                ['label' => $ll . ':space_class_7', 'value' =>  '7'],
            ],
            'default'    => '',
        ],
    ],
    'space_after_class'  => [
        'exclude' => true,
        'label'   => $ll . ':space_after',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':space_class_none', 'value' => '0'],
                ['label' => $ll . ':space_class_1', 'value' =>  '1'],
                ['label' => $ll . ':space_class_2', 'value' =>  '2'],
                ['label' => $ll . ':space_class_3', 'value' =>  '3'],
                ['label' => $ll . ':space_class_4', 'value' =>  '4'],
                ['label' => $ll . ':space_class_5', 'value' =>  '5'],
                ['label' => $ll . ':space_class_6', 'value' =>  '6'],
                ['label' => $ll . ':space_class_7', 'value' =>  '7'],
            ],
            'default'    => '',
        ],
    ],
    'padding_side_class'  => [
        'exclude' => true,
        'label'   => $ll . ':padding_side',
        'config'  => [
            'type'       => 'input',
            'default'    => '',
        ],
    ],
    'padding_inner_class'  => [
        'exclude' => true,
        'displayCond' => 'FIELD:CType:=:textmedia',
        'label'   => $ll . ':padding_inner',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':space_class_none', 'value' => '0'],
                ['label' => $ll . ':space_class_1', 'value' =>  '1'],
                ['label' => $ll . ':space_class_2', 'value' =>  '2'],
                ['label' => $ll . ':space_class_3', 'value' =>  '3'],
                ['label' => $ll . ':space_class_4', 'value' =>  '4'],
                ['label' => $ll . ':space_class_5', 'value' =>  '5'],        
                ['label' => $ll . ':space_class_6', 'value' =>  '6'],
                ['label' => $ll . ':space_class_7', 'value' =>  '7'],
            ],
            'default'    => '',
        ],
    ],
    'animate'  => [
        'exclude' => true,
        'label'   => $ll . ':animate',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':none',            'value' => ''],
                ['label' => $ll . ':fade-in',         'value' => 'fade-in'],
                ['label' => $ll . ':fade-in-and-up',  'value' => 'fade-in-and-up'],
                ['label' => $ll . ':fade-up',         'value' => 'fade-up'],
                ['label' => $ll . ':fade-down',       'value' => 'fade-down'],
                ['label' => $ll . ':fade-right',      'value' => 'fade-right'],
                ['label' => $ll . ':fade-left',       'value' => 'fade-left'],
                ['label' => $ll . ':fade-up-right',   'value' => 'fade-up-right'],
                ['label' => $ll . ':fade-up-left',    'value' => 'fade-up-left'],
                ['label' => $ll . ':fade-down-right', 'value' => 'fade-down-right'],
                ['label' => $ll . ':fade-down-left',  'value' => 'fade-down-left'],
                ['label' => $ll . ':zoom-in',         'value' => 'zoom-in'],
                ['label' => $ll . ':zoom-in-up',      'value' => 'zoom-in-up'],
                ['label' => $ll . ':zoom-in-down',    'value' => 'zoom-in-down'],
                ['label' => $ll . ':zoom-in-right',   'value' => 'zoom-in-right'],
                ['label' => $ll . ':zoom-in-left',    'value' => 'zoom-in-left'],
                ['label' => $ll . ':zoom-out',        'value' => 'zoom-out'],
                ['label' => $ll . ':zoom-out-up',     'value' => 'zoom-out-up'],
                ['label' => $ll . ':zoom-out-down',   'value' => 'zoom-out-down'],
                ['label' => $ll . ':zoom-out-right',  'value' => 'zoom-out-right'],
                ['label' => $ll . ':zoom-out-left',   'value' => 'zoom-out-left'],
                ['label' => $ll . ':slide',           'value' => 'slide'],
                ['label' => $ll . ':slide-up',        'value' => 'slide-up'],  
                ['label' => $ll . ':slide-down',      'value' => 'slide-down'],
                ['label' => $ll . ':slide-right',     'value' => 'slide-right'],                  
                ['label' => $ll . ':slide-left',      'value' => 'slide-left'],                   
            ],
            'default'    => '',
        ],
    ],
    'animate_duration'  => [
        'exclude' => true,
        'displayCond' => 'FIELD:animate:>:0',
        'label'   => $ll . ':animate_duration',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':0',    'value' => '0'],
                ['label' => $ll . ':250',  'value' => '250'],                
                ['label' => $ll . ':500',  'value' => '500'],
                ['label' => $ll . ':750',  'value' => '750'],                
                ['label' => $ll . ':1000', 'value' => '1000'],
                ['label' => $ll . ':1250', 'value' => '1250'],                
                ['label' => $ll . ':1500', 'value' => '1500'],
                ['label' => $ll . ':1750', 'value' => '1750'],
                ['label' => $ll . ':2000', 'value' => '2000'],
                ['label' => $ll . ':2250', 'value' => '2250'],                
                ['label' => $ll . ':2500', 'value' => '2500'],
                ['label' => $ll . ':2750', 'value' => '2750'],                
                ['label' => $ll . ':3000', 'value' => '3000'],
            ],
            'default'    => '1000',
        ],
    ],
    'animate_easing'  => [
        'exclude' => true,
        'displayCond' => 'FIELD:animate:>:0',
        'label'   => $ll . ':animate_easing',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':linear',            'value' => 'linear'],
                ['label' => $ll . ':ease',              'value' => 'ease'],
                ['label' => $ll . ':ease-in',           'value' => 'ease-in'],
                ['label' => $ll . ':ease-out',          'value' => 'ease-out'],
                ['label' => $ll . ':ease-in-out',       'value' => 'ease-in-out'],
                ['label' => $ll . ':ease-in-back',      'value' => 'ease-in-back'],
                ['label' => $ll . ':ease-out-back',     'value' => 'ease-out-back'],
                ['label' => $ll . ':ease-in-out-back',  'value' => 'ease-in-out-back'],
                ['label' => $ll . ':ease-in-sine',      'value' => 'ease-in-sine'],
                ['label' => $ll . ':ease-out-sine',     'value' => 'ease-out-sine'],
                ['label' => $ll . ':ease-in-out-sine',  'value' => 'ease-in-out-sine'],
                ['label' => $ll . ':ease-in-quad',      'value' => 'ease-in-quad'],
                ['label' => $ll . ':ease-out-quad',     'value' => 'ease-out-quad'],
                ['label' => $ll . ':ease-in-out-quad',  'value' => 'ease-in-out-quad'],
                ['label' => $ll . ':ease-in-cubic',     'value' => 'ease-in-cubic'],
                ['label' => $ll . ':ease-out-cubic',    'value' => 'ease-out-cubic'],
                ['label' => $ll . ':ease-in-out-cubic', 'value' => 'ease-in-out-cubic'],
                ['label' => $ll . ':ease-in-quart',     'value' => 'ease-in-quart'],
                ['label' => $ll . ':ease-out-quart',    'value' => 'ease-out-quart'],
                ['label' => $ll . ':ease-in-out-quart', 'value' => 'ease-in-out-quart'],
            ],
            'default'    => 'ease-in-out',
        ],
    ],
    'animate_delay'  => [
        'exclude' => true,
        'displayCond' => 'FIELD:animate:>:0',
        'label'   => $ll . ':animate_delay',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['label' => $ll . ':0',    'value' => '0'],
                ['label' => $ll . ':250',  'value' => '250'],
                ['label' => $ll . ':500',  'value' => '500'],
                ['label' => $ll . ':750',  'value' => '750'],
                ['label' => $ll . ':1000', 'value' => '1000'],
                ['label' => $ll . ':1250', 'value' => '1250'],
                ['label' => $ll . ':1500', 'value' => '1500'],
                ['label' => $ll . ':1750', 'value' => '1750'],
                ['label' => $ll . ':2000', 'value' => '2000'],
                ['label' => $ll . ':2250', 'value' => '2250'],
                ['label' => $ll . ':2500', 'value' => '2500'],
                ['label' => $ll . ':2750', 'value' => '2750'],
                ['label' => $ll . ':3000', 'value' => '3000'],
            ],
            'default'    => '1000',
        ],
    ],
);

$tempfields = array(
    'lightboxstyle' => [
        'exclude' => true,
        'label' => $ll . ':lightboxstyle',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => $ll . ':lightboxstyle0', 'value' =>   '-'],
                ['label' => $ll . ':lightboxstyle1', 'value' =>   'lightboxstyle-a'],
                ['label' => $ll . ':lightboxstyle2', 'value' =>   'lightboxstyle-b'],
                ['label' => $ll . ':lightboxstyle3', 'value' =>   'lightboxstyle-c'],
                ['label' => $ll . ':lightboxstyle4', 'value' =>   'lightboxstyle-d'],
                ['label' => $ll . ':lightboxstyle5', 'value' =>   'lightboxstyle-e'],
            ],
            'default' => 'lightboxstyle-b'
        ]
    ],
    'rollover' => [
        'exclude' => 1,
        'label' => $ll . ':rollover',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'spacing' => [
        'exclude' => 1,
        'label' => $ll . ':spacing',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => $ll . ':space_class_none', 'value' =>  '0'],
                ['label' => $ll . ':space_class_1', 'value' =>  '1'],
                ['label' => $ll . ':space_class_2', 'value' =>  '2'],
                ['label' => $ll . ':space_class_3', 'value' =>  '3'],
                ['label' => $ll . ':space_class_4', 'value' =>  '4'],
                ['label' => $ll . ':space_class_5', 'value' =>  '5'],   
                ['label' => $ll . ':space_class_6', 'value' =>  '6'],
                ['label' => $ll . ':space_class_7', 'value' =>  '7'],   
            ],
        ]
    ],
);


$container = [
    'container' => [
        'exclude' => true,
        'displayCond' => 'USER:T3ac\\T3up\\UserConditions\\DisplayCond->isOnePagerLayout',
        'label' => $ll . ':containerhandle',
        'config' => [
            'type' => 'check'
        ],
    ],
    'objectfit' => [
        'exclude' => true,
        'displayCond' => 'FIELD:container:>:0',
        'label' => $ll . ':objectfit',
        'config' => [
            'type' => 'check',
            'default' => 0
        ],
    ],
    'bgcolor' => [
        'exclude' => true,
        'displayCond' => 'FIELD:container:>:0',
        'label' => $ll . ':bgcolor',
        'config' => [
            'type' => 'input',
            'renderType' => 'color',
            'size' => 20,
            'max' => 1024,
            'eval' => 'trim',
            'valuePicker' => [
                'items' => [
                    [$ll . ':none', 'inherit'],
                    [$ll . ':basecolor', '  '],
                    [$ll . ':white', '#ffffff'],
                    [$ll . ':lightgrey', '#efefef'],
                    [$ll . ':grey', '#DADADA'],
                    [$ll . ':darkergrey', '#787878'],
                    [$ll . ':darkgrey', '#454545'],
                    [$ll . ':black', '#000000'],
                    [$ll . ':blue', '#346097'],
                    [$ll . ':orange', '#FF8700'],
                    [$ll . ':red', '#A50F19'],
                    [$ll . ':green', '#406C03'],
                    [$ll . ':turquoise', '#1D725F'],
                    [$ll . ':violett', '#863177'],
                    [$ll . ':yellow', '#F5F507'],
                    [$ll . ':darkblue', '#2D4F9A'],
                ],
            ],
            'default'    => 'inherit',
        ]
    ],
    'txtcolor' => [
        'exclude' => true,
        'displayCond' => 'FIELD:container:>:0',
        'label' => $ll . ':txtcolor',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => $ll . ':none',     'value' =>  ''],
                ['label' => $ll . ':white',    'value' =>  'white'],
                ['label' => $ll . ':lightgrey', 'value' =>  'lightgrey'],
                ['label' => $ll . ':grey', 'value' =>  'grey'],
                ['label' => $ll . ':darkergrey', 'value' =>  'darkergrey'],
                ['label' => $ll . ':darkgrey', 'value' =>  'darkgrey'],
                ['label' => $ll . ':black', 'value' =>  'black'],
                ['label' => $ll . ':orange', 'value' =>  'orange'],
                ['label' => $ll . ':blue', 'value' =>  'blue'],
                ['label' => $ll . ':darkblue', 'value' =>  'darkblue'],                
                ['label' => $ll . ':red', 'value' =>  'red'],
                ['label' => $ll . ':green', 'value' =>  'green'],
                ['label' => $ll . ':violett', 'value' =>  'violett'],
                ['label' => $ll . ':turquoise', 'value' =>  'turquoise'],
                ['label' => $ll . ':yellow', 'value' =>  'yellow'],               
            ],
         'default'    => '',
        ],
    ],
];

// **********************************************************************************

// Felder der allgemeinen Datensatzbeschreibung hinzufuegen - noch keine Ausgabe im Backend!
\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['tt_content']['columns'],
    $padding
    );

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['tt_content']['columns'],
    $tempfields
    );

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['tt_content']['columns'],
    $container
    );

// **********************************************************************************

$GLOBALS['TCA']['tt_content']['palettes']['newpadding_fields'] = [
    'showitem' => '
        padding_before_class,
        padding_after_class,
        padding_side_class,
        padding_inner_class,
    ',
    'isHiddenPalette' => false,
];

$GLOBALS['TCA']['tt_content']['palettes']['sidepadding_fields'] = [
    'showitem' => '
        padding_side_class,
    ',
    'isHiddenPalette' => false,
];

$GLOBALS['TCA']['tt_content']['palettes']['animation_fields'] = [
    'showitem' => '
        animate,
        animate_duration,
        animate_easing,
        animate_delay,
    ',
    'isHiddenPalette' => false,
];


$GLOBALS['TCA']['tt_content']['palettes']['lightboxstyle_fields'] = [
    'showitem' => '
        lightboxstyle,
        spacing,
        rollover
    ',
    'isHiddenPalette' => false,
];

$GLOBALS['TCA']['tt_content']['palettes']['onepager_fields'] = [
    'showitem' => '
        container,
        objectfit,
         --linebreak--,
         bgcolor,txtcolor,
    ',
    'isHiddenPalette' => false,
];

// ********************************************************************************************

// Palette hinzufuegen, nach Layout - dadurch Anzeige im Backend

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':padding_class;newpadding_fields','textmedia,buttons,menu_pages','before:sectionIndex');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':animation_class;animation_fields','textmedia,t3up_hero,headerbutton,imagebutton,symbolbutton,youtubevideo_pi1,uploads','before:sectionIndex');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':container_class;onepager_fields','textmedia,text,header,table,1cols,2cols,3cols,4cols,buttons,arccodion,news_newsliststicky,news_newsdetail;','before:sectionIndex');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':padding_class;sidepadding_fields','header,table,1cols,2cols,3cols,4cols,uploads','after:frame_class');



// ************** Lightbox *******************************************************************

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':sorting;lightboxstyle_fields', 'textmedia', 'after:image_zoom');


