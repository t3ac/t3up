<?php

defined('TYPO3') or die('Access denied.');

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor::class] = [
    'className' => T3ac\T3up\Xclass\GalleryProcessor::class
];

//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \T3ac\T3up\Hooks\DataHandlerHook::class;

//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapAfterDatabaseOperations'][] = \T3ac\T3up\Hooks\DataHandlerHook::class . '->processDatamap_afterDatabaseOperations';

// Add default RTE configuration
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3up'] = 'EXT:t3up/Configuration/RTE/T3up.yaml';