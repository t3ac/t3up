<?php
/**********************************************************************
 * Extension Manager/Repository config file for Sitepackage ext "t3up".
 *********************************************************************/
/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
    'title'            => 'T3UP - Basic Installation',
    'description'      => 'T3UP - Distribution.',
    'version'          => '1.0.1',
    'state'            => 'stable',
    'category'         => 'templates',
    'author'           => 'Michael Lang',
    'author_email'     => 'michael.lang@h-da.de',
    'author_company'   => 'h_da Hochschule Darmstadt',
    'uploadfolder'     => false,
    'createDirs'       => '',
    'clearCacheOnLoad' => false,
    'constraints'      => [
        'depends'   => [
            'typo3'            => '10.4.1-1.5.99',
            'ws_scss'          => '11.0.0-',
        ],
        'conflicts' => [],
        'suggests'  => [],
    ],
];
