<?php

declare(strict_types=1);

namespace T3ac\T3up\Xclass;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */


class GalleryProcessor extends \TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor
{

    /**
     * Matching the tt_content field towards the imageOrient option
     *
     * @var array
     */
    protected $availableGalleryPositions = [
        'horizontal' => [
            'center' => [0, 8, 50],
            'right' => [1, 9, 17, 25, 51],
            'left' => [2, 10, 18, 26, 52]
        ],
        'vertical' => [
            'above' => [0, 1, 2,50, 51, 52],
            'intext' => [17, 18, 25, 26],
            'below' => [8, 9, 10]
        ]
    ];
 
}
