<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (ExtensionManagementUtility::isLoaded('powermail')) {
    $GLOBALS['TCA']['tx_powermail_domain_model_page']['columns']['title']['l10n_mode'] = 'prefixLangTitle';
}