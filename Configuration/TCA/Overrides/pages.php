<?php
defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

(static function (): void {
    
    $GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
        'Brofix',
        'brofix',
        'apps-pagetree-folder-contains-brofix',
    ];
    $GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-brofix']
    = 'apps-pagetree-folder-contains-brofix';
    
})();

$pagesColumns = array(
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
    'pagecolor' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-no', ''],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-blue', 'blue'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-orange', 'orange'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-red', 'red'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-green', 'green'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-violett', 'violett'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-yellow', 'yellow'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-grey', 'grey'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:pagecolor-turquoise', 'turquoise'],
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
    
);


$GLOBALS['TCA']['pages']['palettes']['t3up'] = array(
    'canNotCollapse' => true,
    'showitem' => 'pagecolor,--linebreak--,showtitle,deltitle,--linebreak--,breadcrumb,previousnext,--linebreak--,hidenav,nonav'
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $pagesColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'xtrafunction,--palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:palette;t3up', '', 'after:title');


