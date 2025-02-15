<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (ExtensionManagementUtility::isLoaded('powermail')) {
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['title']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['text']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['prefill_value']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['placeholder']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['content_element']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['description']['l10n_mode'] = 'prefixLangTitle';
    $GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['settings']['l10n_mode'] = 'prefixLangTitle';
}