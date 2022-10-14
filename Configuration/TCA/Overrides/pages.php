<?php
defined('TYPO3_MODE') or die();

$pagesColumns = [
    'showtitle' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:showtitle',
        'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
    'deltitle' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:deltitle',
        'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
    'breadcrumb' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:breadcrumb',
        'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
    'hidenav' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:hidenav',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],   
    'nonav' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:nonav',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],   
    'basecolor' => [
           'exclude' => true,
           'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor',
           'config' => [
               'type' => 'select',
               'renderType' => 'selectSingle',
               'items' => [
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-no', ''],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-blue', 'blue'],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-orange', 'orange'],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-red', 'red'],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-green', 'green'],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-violett', 'violett'],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-yellow', 'yellow'],
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-grey', 'grey'],          
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-turquoise', 'turquoise'], 
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-darkblue', 'darkblue'],        
                   ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:basecolor-darkgrey', 'darkgrey'],                   
                   ],
               'default' => ''
           ]
    ],
    'previousnext' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:previousnext ',
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
