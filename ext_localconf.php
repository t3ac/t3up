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
    
    # Layouts #####################################
    
    # Enable/dissable the Standard-Layout -> addPageTSConfig
    if ($Configuration['StandardLayout']) {
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/StandardLayout.tsconfig'");
    }
    
    # Enable/dissable the OneColumn-Layout -> addPageTSConfig
    if ($Configuration['OneColumnLayout']) {
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/OneColumnLayout.tsconfig'");
    }
    
    # Enable/dissable the LeftNavigationLayout -> addPageTSConfig
    if ($Configuration['LeftNavigationLayout']) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts/setup.tsconfig'");
        ExtensionManagementUtility::addTypoScriptConstants("@import 'EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts/constants.tsconfig'");
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/LeftNavigationLayout.tsconfig'");
    }
    
    # Enable/dissable the LeftNavigationMarginalLayout -> addPageTSConfig
    if ($Configuration['LeftNavigationMarginalLayout']) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts/setup.tsconfig'");
        ExtensionManagementUtility::addTypoScriptConstants("@import 'EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts/constants.tsconfig'");
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/LeftNavigationMarginalLayout.tsconfig'");
    }
    
    # Enable/dissable the RightNavigationLayout -> addPageTSConfig
    if ($Configuration['RightNavigationLayout']) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TsConfig/RightNavigationLayouts/setup.tsconfig'");
        ExtensionManagementUtility::addTypoScriptConstants("@import 'EXT:t3up/Configuration/TsConfig/RightNavigationLayouts/constants.tsconfig'");
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/RightNavigationLayout.tsconfig'");
    }
    
    # Enable/dissable the RightMarginalLayout -> addPageTSConfig
    if ($Configuration['RightMarginalLayout']) {
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/RightMarginalLayout.tsconfig'");
    }
    
    # Enable/dissable the ContentRightMarginalLayout -> addPageTSConfig
    if ($Configuration['ContentRightMarginalLayout']) {
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/ContentRightMarginalLayout.tsconfig'");
    }
    
    # Enable/dissable the ContentRightMarginalLayout -> addPageTSConfig
    if ($Configuration['ContentLeftMarginalLayout']) {
        ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t3up/Configuration/TsConfig/Layouts/ContentLeftMarginalLayout.tsconfig'");
    }
    

    # Extensions #####################################
    

    if (ExtensionManagementUtility::isLoaded('solr')) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Solr/solr.typoscript'");
    }

    if (ExtensionManagementUtility::isLoaded('ke_search')) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/KeSearch/kesearch.typoscript'");
    }
    
    if (ExtensionManagementUtility::isLoaded('jpfaq')) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Jpfaq/jpfaq.typoscript'");
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
    
    if (ExtensionManagementUtility::isLoaded('fs_media_gallery')) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/FsMediaGallery/setup.typoscript'");
        ExtensionManagementUtility::addTypoScriptConstants("@import 'EXT:t3up/Configuration/TypoScript/Extensions/FsMediaGallery/constants.typoscript'");
    }
    
    if (ExtensionManagementUtility::isLoaded('min')) {
        ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:t3up/Configuration/TypoScript/Extensions/Min/min.typoscript'");
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
    