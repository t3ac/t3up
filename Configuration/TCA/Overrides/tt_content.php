<?php
defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

$padding = array(
    'padding_before_class' => [
        'exclude' => true,
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_before',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_none', '0'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_1', '1'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_2', '2'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_3', '3'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_4', '4'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_5', '5'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_6', '6'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_7', '7'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_8', '8'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_9', '9'],
            ],
            'default'    => '',
        ],
    ],
    'padding_after_class'  => [
        'exclude' => true,
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_after',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_none', '0'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_1', '1'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_2', '2'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_3', '3'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_4', '4'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_5', '5'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_6', '6'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_7', '7'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_8', '8'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_9', '9'],
            ],
            'default'    => '',
        ],
    ],
    'padding_side_class'  => [
        'exclude' => true,
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_side',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_none', '0'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_1', '1'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_2', '2'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_3', '3'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_4', '4'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_5', '5'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_6', '6'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_7', '7'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_8', '8'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_9', '9'],
            ],
            'default'    => '',
        ],
    ],
    'padding_inner_class'  => [
        'exclude' => true,
        'displayCond' => 'FIELD:CType:=:textmedia',
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_inner',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_none', '0'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_1', '1'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_2', '2'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_3', '3'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_4', '4'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_5', '5'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_6', '6'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_7', '7'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_8', '8'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:space_class_9', '9'],
            ],
            'default'    => '',
        ],
    ],
);

$tempfields = array(
    'lightboxstyle' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle0', '-'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle1', 'lightboxstyle-a'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle2', 'lightboxstyle-b'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle3', 'lightboxstyle-c'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle4', 'lightboxstyle-d'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:lightboxstyle5', 'lightboxstyle-e'],
                ],
            'default' => 'lightboxstyle-b'
        ]
    ],
    'inf' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:inf',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'rollover' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:rollover',
        'config' => [
            'type' => 'check',
            'default' => 0
        ]
    ],
    'spacing' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing0', '0'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing1', '025'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing2', '033'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing3', '050'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing4', '066'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing5', '075'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing6', '1'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing7', '150'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing8', '2'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:spacing9', '3'],
            ],
        ]
    ],
);


// **********************************************************************************

// Felder der allgemeinen Datensatzbeschreibung hinzufuegen - noch keine Ausgabe im Backend!
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $padding
    );
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $tempfields
);

// **********************************************************************************

// Felder der neuen Palette hinzufügen
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'padding_fields',
    'padding_before_class,padding_side_class,padding_after_class,padding_inner_class'
    );
	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
 'tt_content',
 'lightboxstyle_fields',
 'lightboxstyle,spacing,inf,rollover'
);

// **********************************************************************************

// Palette hinzufuegen, nach Layout - dadurch Anzeige im Backend
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content','--palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class;padding_fields', '', 'after:layout');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
'tt_content','--palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:sorting;lightboxstyle_fields', 'textpic,textmedia,image', 'after:image_zoom');

// **********************************************************************************

$GLOBALS['TCA']['tt_content']['columns']['subheader']['l10n_mode'] = 'prefixLangTitle';
