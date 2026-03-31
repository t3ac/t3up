<?php
defined('TYPO3') or die();

// Sprachdatei
$ll = 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf';

$pagesColumns = [
    'showtitle' => [
        'exclude' => true,
        'label' => $ll . ':showtitle',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'deltitle' => [
        'exclude' => true,
        'label' => $ll . ':deltitle',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'breadcrumb' => [
        'exclude' => true,
        'label' => $ll . ':breadcrumb',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'hidenav' => [
        'exclude' => true,
        'label' => $ll . ':hidenav',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'nonav' => [
        'exclude' => true,
        'label' => $ll . ':nonav',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'basecolor' => [
        'exclude' => true,
        'label' => $ll . ':basecolor',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => $ll . ':basecolor-no', 'value' =>  ''],
                ['label' => $ll . ':basecolor-blue', 'value' =>  'blue'],
                ['label' => $ll . ':basecolor-orange', 'value' =>  'orange'],
                ['label' => $ll . ':basecolor-red', 'value' =>  'red'],
                ['label' => $ll . ':basecolor-green', 'value' => 'green'],
                ['label' => $ll . ':basecolor-violett', 'value' =>  'violett'],
                ['label' => $ll . ':basecolor-yellow', 'value' =>  'yellow'],
                ['label' => $ll . ':basecolor-grey', 'value' =>  'grey'],
                ['label' => $ll . ':basecolor-turquoise', 'value' =>  'turquoise'],
                ['label' => $ll . ':basecolor-darkblue', 'value' =>  'darkblue'],
                ['label' => $ll . ':basecolor-darkgrey', 'value' =>  'darkgrey'],
            ],
            'default' => ''
        ]
    ],
    'previousnext' => [
        'exclude' => true,
        'label' => $ll . ':previousnext',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    
];

$GLOBALS['TCA']['pages']['palettes']['t3up'] = [
    'canNotCollapse' => true,
    'showitem' => 'basecolor,--linebreak--,showtitle,deltitle,--linebreak--,breadcrumb,previousnext,--linebreak--,hidenav,nonav'
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $pagesColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'xtrafunction,--palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:palette;t3up', '', 'after:title');
