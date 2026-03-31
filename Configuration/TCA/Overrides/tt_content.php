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
                ['label' => $ll . ':space_class_8', 'value' =>  '8'],
                ['label' => $ll . ':space_class_9', 'value' =>  '9'],
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
                ['label' => $ll . ':space_class_8', 'value' =>  '8'],
                ['label' => $ll . ':space_class_9', 'value' =>  '9'],
            ],
            'default'    => '',
        ],
    ],
    'padding_side_class'  => [
        'exclude' => true,
        'label'   => $ll . ':padding_side',
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
                ['label' => $ll . ':space_class_8', 'value' =>  '8'],
                ['label' => $ll . ':space_class_9', 'value' =>  '9'],
            ],
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
                ['label' => $ll . ':space_class_8', 'value' =>  '8'],
                ['label' => $ll . ':space_class_9', 'value' =>  '9'],
            ],
            'default'    => '',
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
    'inf' => [
        'exclude' => 1,
        'label' => $ll . ':inf',
        'config' => [
            'type' => 'check',
            'default' => 0
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
                ['label' => $ll . ':spacing0', 'value' =>  '0'],
                ['label' => $ll . ':spacing1', 'value' =>  '25'],
                ['label' => $ll . ':spacing2', 'value' =>  '33'],
                ['label' => $ll . ':spacing3', 'value' =>  '50'],
                ['label' => $ll . ':spacing4', 'value' =>  '66'],
                ['label' => $ll . ':spacing5', 'value' =>  '75'],
                ['label' => $ll . ':spacing6', 'value' =>  '1'],
                ['label' => $ll . ':spacing7', 'value' =>  '150'],
                ['label' => $ll . ':spacing8', 'value' =>  '2'],
                ['label' => $ll . ':spacing9', 'value' =>  '3'],
            ],
        ]
    ],
);



$container = [
    'container' => [
        'exclude' => true,
        'label' => $ll . ':containerhandle',
        'config' => [
            'type' => 'check',
            'default' => 0
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
    'bgimage' => [
        'exclude' => true,
        'displayCond' => [
            'AND'  => [
                'FIELD:container:>:0',
                'OR' => [
                    'FIELD:CType:=:textmedia',
                    'FIELD:CType:=:1cols',
                    'FIELD:CType:=:2cols',
                    'FIELD:CType:=:3cols',
                    'FIELD:CType:=:4cols',
                ]
            ],
        ],
        'label' => $ll . ':bgimage',
        'config' => [
            'type' => 'file',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
            'maxitems' => 1,
            'allowed' => 'webp,jpg,jepg,png,svg' ,
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
            'type' => 'input',
            'renderType' => 'color',
            'size' => 20,
            'max' => 1024,
            'eval' => 'trim',
            'valuePicker' => [
                'items' => [
                    [$ll . ':none', 'inherit'],
                    [$ll . ':blacktxt', '#000000'],
                    [$ll . ':whitetxt', '#ffffff'],
                    [$ll . ':darkgreytxt', '#454545'],
                ],            ],
            'default'    => 'inherit',
        ]
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

// Felder der neuen Palette hinzufügen
$GLOBALS['TCA']['tt_content']['palettes']['padding_fields'] = [
    'showitem' => '
        padding_before_class,
        padding_side_class,
        padding_after_class,
        padding_inner_class,
    ',
    'isHiddenPalette' => false,
];

$GLOBALS['TCA']['tt_content']['palettes']['lightboxstyle_fields'] = [
    'showitem' => '
        lightboxstyle,
        spacing,
        inf,
        rollover
    ',
    'isHiddenPalette' => false,
];

$GLOBALS['TCA']['tt_content']['palettes']['onepager_fields'] = [
    'showitem' => '
        --linebreak--,
        container,
        objectfit,
        --linebreak--,
         bgimage,
         --linebreak--,
         bgcolor,txtcolor,
    ',
    'isHiddenPalette' => false,
];



// **********************************************************************************

// Palette hinzufuegen, nach Layout - dadurch Anzeige im Backend
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':padding_class;padding_fields', '', 'after:layout');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':sorting;lightboxstyle_fields', 'textpic,textmedia,image', 'after:image_zoom');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;' . $ll . ':padding_class;onepager_fields', '', 'before:layout');



// **********************************************************************************

$GLOBALS['TCA']['tt_content']['columns']['subheader']['l10n_mode'] = 'prefixLangTitle';

$GLOBALS['TCA']['tt_content']['columns']['container']['displayCond'] = 'USER:Hda\\T3up\\Conditions\\OnePagerLayoutCondition->matchCondition';


