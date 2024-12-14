<?php
defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    't3up', 'Configuration/TypoScript/', 'T3UP - Setup-Installation'
);