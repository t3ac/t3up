<?php

/*
 * This file is part of the package T3UP-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();


$boot = static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['cs_presets'] = 'EXT:t3up/Configuration/Rte/CsPresets.yaml';
    
    $GLOBALS['TCA']['pages']['columns']['title']['config']['max'] = 50;
    $GLOBALS['TCA']['pages']['columns']['title']['config']['size'] = 30;
    $GLOBALS['TCA']['pages']['columns']['nav_title']['config']['max'] = 50;
    $GLOBALS['TCA']['pages']['columns']['nav_title']['config']['size'] = 30;
    
    $GLOBALS['TCA']['tt_content']['columns']['imagecols']['config']['default'] = 1;
    $GLOBALS['TCA']['tt_content']['columns']['header']['config']['type'] = 'text';
    $GLOBALS['TCA']['tt_content']['columns']['header']['config']['cols'] = '60';
    $GLOBALS['TCA']['tt_content']['columns']['header']['config']['rows'] = '2';
    $GLOBALS['TCA']['tt_content']['columns']['header']['config']['eval'] = 'required';
    
};

$boot();
unset($boot);

