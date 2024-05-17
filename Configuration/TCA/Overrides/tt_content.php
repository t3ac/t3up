<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

$padding = array(
    'padding_before_class' => [
        'exclude' => true,
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:paddingBeforeClass',
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
            ],
            'default'    => '',
        ],
    ],
    'padding_after_class'  => [
        'exclude' => true,
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:paddingAfterClass',
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
            ],
            'default'    => '',
        ],
    ],
);

### Felder der allgemeinen Datensatzbeschreibung hinzufuegen - noch keine Ausgabe im Backend!
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $padding
);

### Felder der neuen Palette hinzufügen
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
 'tt_content',
 'padding_fields',
 'padding_before_class,padding_after_class'
);

### Palette hinzufuegen, nach Layout - dadurch Anzeige im Backend
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
'tt_content','--palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class;padding_fields', '', 'after:layout');


$GLOBALS['TCA']['tt_content']['columns']['subheader']['l10n_mode'] = 'prefixLangTitle';