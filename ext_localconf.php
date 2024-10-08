<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor::class] = [
	'className' => T3ac\T3up\Xclass\GalleryProcessor::class
];


call_user_func(static function () {
	
	
	# Abfrage, ob es im Backend unter Extensions eine Configurationsdatei gibt, wenn ja dann soll diese ausgeführt werden.
	# die Konfiguration für das Backend ist in der Datei ext_conf_template.txt
	# The extension configuration -----------------------------------------------------------------------#
   
	
	if (class_exists('TYPO3\CMS\Core\Configuration\ExtensionConfiguration')) {
		$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
			\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
			);
		$Configuration = $extensionConfiguration->get('t3up');
	} else {
		$Configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('t3up');
		if (!is_array($Configuration)) {
			$Configuration = unserialize($Configuration);
		}
	}

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
	
	# Enable/dissable the RTE -> addPageTSConfig
	if ($Configuration['RTE']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Rte.tsconfig'");
	}
	
	# Enable/dissable the UserTS -> addUserTSConfig
	if ($Configuration['UserTs']) {
		ExtensionManagementUtility::addUserTSConfig("@import 'EXT:t3up/Configuration/TsConfig/User.tsconfig'");
	}
	
	# Layouts with Navigation #####################################
	
	# Enable/dissable the LeftNavigation-Layout -> addPageTSConfig
	if ($Configuration['LeftNavigation']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/LeftNavigation.tsconfig'");
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Subnavigation/setup.typoscript'");
	}
	
	# Enable/dissable the LeftNavigationMarginal-Layout -> addPageTSConfig
	if ($Configuration['LeftNavigationMarginal']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/LeftNavigationMarginal.tsconfig'");
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Subnavigation/setup.typoscript'");
	}
	
	# Enable/dissable the LeftNavigationInMedia-Layout -> addPageTSConfig
	if ($Configuration['LeftNavigationInMedia']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/LeftNavigationInMedia.tsconfig'");
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Subnavigation/setup.typoscript'");
	}

	# Enable/dissable the RightNavigation-Layout -> addPageTSConfig
	if ($Configuration['RightNavigation']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/RightNavigation.tsconfig'");
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Subnavigation/setup.typoscript'");
	}
	
	# Enable/dissable the RightNavigationInMedia-Layout -> addPageTSConfig
	if ($Configuration['RightNavigationInMedia']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/RightNavigationInMedia.tsconfig'");
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Subnavigation/setup.typoscript'");
	}

	# Enable/dissable the Standard-Layout -> addPageTSConfig
	if ($Configuration['Standard']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/Standard.tsconfig'");
	}

	# Enable/dissable the OneColumn-Layout -> addPageTSConfig
	if ($Configuration['OneColumn']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/OneColumn.tsconfig'");
	}

	# Enable/dissable the RightMarginal-Layout -> addPageTSConfig
	if ($Configuration['RightMarginal']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/RightMarginal.tsconfig'");
	}

	# Enable/dissable the BigLeft-Layout -> addPageTSConfig
	if ($Configuration['BigLeft']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/BigLeft.tsconfig'");
	}

	# Enable/dissable the BigRight-Layout -> addPageTSConfig
	if ($Configuration['BigRight']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/BigRight.tsconfig'");
	}

	# Enable/dissable the SmallLeft-Layout -> addPageTSConfig
	if ($Configuration['SmallLeft']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/SmallLeft.tsconfig'");
	}

	# Enable/dissable the SmallRight-Layout -> addPageTSConfig
	if ($Configuration['SmallRight']) {
		ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/SmallRight.tsconfig'");
	}
	
	# Extensions #####################################

	if (ExtensionManagementUtility::isLoaded('solr')) {
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Solr/solr.typoscript'");
	}

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
	
	if (ExtensionManagementUtility::isLoaded('ods_osm')) {
		ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Odsom/setup.typoscript'");
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
	
	
});
	
