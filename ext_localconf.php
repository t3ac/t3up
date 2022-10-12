<?php

/*
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

use TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor;

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor::class] = [
<<<<<<< HEAD
  // 'className' => T3UP\T3up\Xclass\GalleryProcessor::class
=======
   'className' => T3UP\T3up\Xclass\GalleryProcessor::class
>>>>>>> 1b0432ec445a720349857a458b020e2827c5e1f2
];


$boot = function () {
    
    #####################################################################################################
        
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

    # Enable/dissable the TCEForm/ImagePredefinitions -> addPageTSConfig  
    if ($Configuration['TCEForm']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/TCEForm.typoscript">');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/TCEImagePreDefinitions.typoscript">');
    }
    
    # Enable/dissable the TCEFrames -> addPageTSConfig  
    if ($Configuration['TCEFrames']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/TCEFrames.typoscript">');    
    }

    # Enable/dissable the TCEMain -> addPageTSConfig
    if ($Configuration['TCEMain']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/TCEMain.typoscript">');
    }
    
    # Enable/dissable the RTE -> addPageTSConfig
    if ($Configuration['RTE']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/Rte.typoscript">');
    }
    
    # Enable/dissable the UserTS -> addUserTSConfig
    if ($Configuration['UserTs']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/User.typoscript">');
    } 
        
    # Enable/dissable the Standard-Layout -> addPageTSConfig
    if ($Configuration['StandardLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/Layouts/StandardLayout.typoscript">');
    }  
    
    # Enable/dissable the OneColumn-Layout -> addPageTSConfig
    if ($Configuration['OneColumnLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/Layouts/OneColumnLayout.typoscript">');
    }  
    
    # Enable/dissable the OneColumnContainer-Layout -> addPageTSConfig
    if ($Configuration['OneColumnContainerLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/Layouts/OneColumnContainerLayout.typoscript">');
    }  
    
    # Enable/dissable the 3Col-Layout -> addPageTSConfig
    if ($Configuration['ThreeColumnLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/Layouts/ThreeColumnLayout.typoscript">');
    } 
    
    # Enable/dissable the Right Marginal-Layout -> addPageTSConfig
    if ($Configuration['RightMarginalLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/Layouts/RightMarginalLayout.typoscript">');
    } 
          
    # Enable/dissable the LeftNavigationLayout -> addPageTSConfig
    if ($Configuration['LeftNavigationLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts.typoscript">');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts/setup.typoscript">');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/LeftNavigationLayouts/constants.typoscript">');
    } 
 
    # Enable/dissable the RightNavigationLayout -> addPageTSConfig
    if ($Configuration['RightNavigationLayout']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/RightNavigationLayouts.typoscript">');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/RightNavigationLayouts/setup.typoscript">');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3up/Configuration/TsConfig/RightNavigationLayouts/constants.typoscript">');  
    } 
};

$boot();
unset($boot);
