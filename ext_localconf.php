<?php

defined('TYPO3') or die;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor::class] = [
	'className' => T3ac\T3up\Xclass\GalleryProcessor::class
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \T3ac\T3up\Hooks\DataHandlerHook::class;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapAfterDatabaseOperations'][] = \T3ac\T3up\Hooks\DataHandlerHook::class . '->processDatamap_afterDatabaseOperations';

// Add default RTE configuration
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3up'] = 'EXT:t3up/Configuration/RTE/T3up.yaml';

# Add Image-Layouts
ExtensionManagementUtility::addPageTsConfig("@import 'EXT:t3up/Configuration/TsConfig/ImageLayouts.tsconfig'");



# Auslesen Konfiguration ext_conf_template.txt ###############################################
$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
     \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
      );

$Configuration = $extensionConfiguration->get('t3up');

# Div. Konfigurationen #######################################################################

# Enable/dissable the Bootstrap Frames  -> addPageTSConfig
if ($Configuration['BootstrapFrames']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/BootstrapDesign.tsconfig'");
}

# Enable/dissable the Design Frames  -> addPageTSConfig
if ($Configuration['DesignFrames']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Design.tsconfig'");
}

# Enable/dissable the Permissions -> addPageTSConfig
if ($Configuration['Permission']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Permission.tsconfig'");
}

# Enable/dissable Add the TableLayouts -> addPageTSConfig
if ($Configuration['TableLayouts']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/TableLayouts.tsconfig'");
}

# Enable/dissable Add the ImageLayouts -> addPageTSConfig
if ($Configuration['ImageLayouts']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/ImageLayouts.tsconfig'");
}

# Layouts with Navigation #####################################################################

# Enable/dissable the LeftNavigation-Layout -> addPageTSConfig
if ($Configuration['LeftNavigation']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/PageTsConfig/BackendLayouts/LeftNavigation.tsconfig'");
}

# Enable/dissable the RightNavigation-Layout -> addPageTSConfig
if ($Configuration['RightNavigation']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/PageTsConfig/BackendLayouts/RightNavigation.tsconfig'");
}

# Enable/dissable the RightMarginal-Layout -> addPageTSConfig
if ($Configuration['RightMarginal']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/PageTsConfig/BackendLayouts/RightMarginal.tsconfig'");
}

# Enable/dissable the OneColumn-Layout -> addPageTSConfig
if ($Configuration['OneColumn']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/PageTsConfig/BackendLayouts/OneColumn.tsconfig'");
}

# Enable/dissable the OnePager-Layout -> addPageTSConfig
if ($Configuration['OnePager']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/PageTsConfig/BackendLayouts/OnePager.tsconfig'");
}

# Icon Provider ################################################################################

$icons = [
    'apps-pagetree-folder-contains-brofix' => 'brofix.svg',
];

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($icons as $identifier => $path) {
    if (!$iconRegistry->isRegistered($identifier)) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:t3up/Resources/Public/Icons/' . $path]
            );
    }
}

