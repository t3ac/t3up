<?php
defined('TYPO3_MODE') or die();

$padding = [
    'padding_before_class' => [
        'exclude' => true,
        'label'   => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:paddingBeforeClass',
        'config'  => [
            'type'       => 'select',
            'renderType' => 'selectSingle',
            'items'      => [
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_none', ''],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_0', '0px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_5', '5px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_10', '10px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_15', '15px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_20', '20px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_30', '30px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_45', '45px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_60', '60px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_75', '75px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_90', '90px'],
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
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_none', ''],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_0', '0px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_5', '5px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_10', '10px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_15', '15px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_20', '20px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_30', '30px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_45', '45px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_60', '60px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_75', '75px'],
                ['LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class_90', '90px'],
            ],
            'default'    => '',
        ],
    ],
];

/*********************************************************************************************************/

// Felder der allgemeinen Datensatzbeschreibung hinzufuegen - noch keine Ausgabe im Backend!
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $padding
);

/*********************************************************************************************************/

// Felder der neuen Palette hinzufügen
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
 'tt_content',
 'padding_fields',
 'padding_before_class,padding_after_class'
);

/*********************************************************************************************************/

// Diese Zeile muss auch in Gridelements in gridelements/Configuration/TCA/Overrides/tt_content.php ~ in Zeile 135!!
// --palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_be.xlf:padding_class;padding_fields
// --palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_be.xlf:padding_class;padding_fields,container // wenn Fullpage aktiviert ist, also t3up_onepager


// Palette hinzufügen, nach Layout - dadurch Anzeige im Backend
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
'tt_content','--palette--;LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf:padding_class;padding_fields', '', 'after:layout');
