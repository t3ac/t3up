<?php

defined('TYPO3') or die;

$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['cs_presets'] = 'EXT:t3up/Configuration/Rte/CsPresets.yaml';

$GLOBALS['TCA']['pages']['columns']['title']['config']['max'] = 80;
$GLOBALS['TCA']['pages']['columns']['title']['config']['size'] = 30;
$GLOBALS['TCA']['pages']['columns']['nav_title']['config']['max'] = 50;
$GLOBALS['TCA']['pages']['columns']['nav_title']['config']['size'] = 30;

$GLOBALS['TCA']['tt_content']['columns']['imagecols']['config']['default'] = 1;
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['type'] = 'text';
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['cols'] = '60';
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['rows'] = '2';
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['eval'] = 'required';



(function () {
    
    //register backend module
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'T3ac\T3up',
        'Brofix',
        '',
        '',
        [],
        [
            'icon'   => 'EXT:t3up/Resources/Public/Icons/brofix.svg',
            'access' => 'user,group',
            'labels' => 'LLL:EXT:t3up/Resources/Private/Language/locallang_backend.xlf',
        ]
        );
})();

