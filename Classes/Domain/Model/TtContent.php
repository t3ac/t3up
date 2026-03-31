<?php

namespace T3ac\T3up\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
/**
 * Model of tt_content
 */
class TtContent extends AbstractEntity
{

    /**
     * @var string
     */
    protected $bgimage = '';

    /**
     * @return string
     */
    public function getBgimage(): string
    {
        return $this->bgimage;
    }

    /**
     * @param $image
     *
     * @return void
     */
    public function setBgimage(string $bgimage): void
    {
        $this->bgimage = $bgimage;
    }

}
