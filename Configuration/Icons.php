<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;


return [
    't3up-leftnavigation' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/BackendLayouts/LeftNavigation.svg',
    ],
    't3up-rightnavigation' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/BackendLayouts/RightNavigation.svg',
    ],
    't3up-rightmarginal' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/BackendLayouts/RightMarginal.svg',
    ],
    't3up-default' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/BackendLayouts/default.svg',
    ],
    't3up-onepager' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/BackendLayouts/OnePager.svg',
    ],
    't3up-onecolumn' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/BackendLayouts/OneColumn.svg',
    ],
    'apps-pagetree-folder-contains-brofix' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/brofix.svg',
    ],
    'header-below-left' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/header-below-left.svg',
    ],
    'header-below-right' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/header-below-right.svg',
    ],
    'header-below' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:t3up/Resources/Public/Icons/header-below.svg',
    ],
];