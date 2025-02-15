<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (ExtensionManagementUtility::isLoaded('news')) {
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['bodytext']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['teaser']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['tx_uniolnewsextra_contact']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['l10n_mode'] = 'prefixLangTitle';
}