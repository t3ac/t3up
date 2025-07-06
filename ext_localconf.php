<?php

defined('TYPO3') or die;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor::class] = [
	'className' => T3ac\T3up\Xclass\GalleryProcessor::class
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \T3ac\T3up\Hooks\DataHandlerHook::class;


// In deiner EXT: t3up/ext_localconf.php
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapAfterDatabaseOperations'][] = \T3ac\T3up\Hooks\DataHandlerHook::class . '->processDatamap_afterDatabaseOperations';

# Auslesen Images
ExtensionManagementUtility::addPageTsConfig("@import 'EXT:t3up/Configuration/TsConfig/TCEIMAGE.tsconfig'");


# Auslesen Konfiguration ext_conf_template.txt

$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
	\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
	);
$Configuration = $extensionConfiguration->get('t3up');


if ($Configuration['TCEForm']) {
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/TCEForm.tsconfig'");
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/TCEImagePreDefinitions.tsconfig'");
}

# Enable/dissable the TCEMain -> addPageTSConfig
if ($Configuration['TCEMain']) {
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/TCEMain.tsconfig'");
}

# Enable/dissable the TCEMain -> addPageTSConfig
if ($Configuration['TCEFrames']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Design.tsconfig'");
}

# Enable/dissable the TCEMain -> addPageTSConfig
if ($Configuration['TCEBootstrapFrames']) {
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/BootstrapDesign.tsconfig'");
}


# Enable/dissable the RTE -> addPageTSConfig
if ($Configuration['RTE']) {
   $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['T3upPreset'] = 'EXT:t3up/Configuration/RTE/T3upPreset.yaml';
	 ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Rte.tsconfig'");
}

# Enable/dissable the UserTS -> addUserTSConfig
if ($Configuration['UserTs']) {
	ExtensionManagementUtility::addUserTSConfig("@import 'EXT:t3up/Configuration/TsConfig/User/User.tsconfig'");
}

# Layouts with Navigation #####################################

# Enable/dissable the LeftNavigation-Layout -> addPageTSConfig
if ($Configuration['LeftNavigation']) {
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/LeftNavigation.tsconfig'");
}

# Enable/dissable the RightNavigation-Layout -> addPageTSConfig
if ($Configuration['RightNavigation']) {
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/RightNavigation.tsconfig'");
}

# Enable/dissable the OneColumn-Layout -> addPageTSConfig
if ($Configuration['OneColumn']) {
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/OneColumn.tsconfig'");
}

# Enable/dissable the OnePager-Layout -> addPageTSConfig
if ($Configuration['OnePager']) {
	ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/OnePager.tsconfig'");
}

# Extensions #####################################

if (ExtensionManagementUtility::isLoaded('ke_search')) {
	ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/KeSearch/setup.typoscript'");
}

if (ExtensionManagementUtility::isLoaded('jpfaq')) {
    ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Jpfaq/setup.typoscript'");
}

if (ExtensionManagementUtility::isLoaded('powermail')) {
	ExtensionManagementUtility::addTypoScriptConstants("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Powermail/constants.typoscript'");
	ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Powermail/powermail.typoscript'");
}

if (ExtensionManagementUtility::isLoaded('news')) {
	ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/News/tx_news.typoscript'");
}
	
if (ExtensionManagementUtility::isLoaded('dpn_glossary')) {
    ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Dpn_glossary/setup.typoscript'");
}

if (ExtensionManagementUtility::isLoaded('fs_media_gallery')) {
	ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/FsMediaGallery/setup.typoscript'");
	ExtensionManagementUtility::addTypoScriptConstants("@import 'EXT:t3up/Configuration/TypoScript/Extensions/FsMediaGallery/constants.typoscript'");
}

if (ExtensionManagementUtility::isLoaded('min')) {
	ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Min/setup.typoscript'");
}

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


