<?php

defined('TYPO3') or die;

$GLOBALS['TCA']['pages']['columns']['title']['config']['max'] = 80;
$GLOBALS['TCA']['pages']['columns']['title']['config']['size'] = 30;
$GLOBALS['TCA']['pages']['columns']['nav_title']['config']['max'] = 50;
$GLOBALS['TCA']['pages']['columns']['nav_title']['config']['size'] = 30;

$GLOBALS['TCA']['tt_content']['columns']['imagecols']['config']['default'] = 1;
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['type'] = 'text';
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['cols'] = '60';
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['rows'] = '2';
$GLOBALS['TCA']['tt_content']['columns']['header']['config']['eval'] = 'required';

$GLOBALS['TCA']['tt_content']['columns']['sectionIndex']['config']['default'] = 0;
