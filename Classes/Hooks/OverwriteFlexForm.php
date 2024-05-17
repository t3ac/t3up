<?php
declare(strict_types=1);
namespace T3ac\T3up\Hooks;

/**
 * Class OverwriteFlexForm
 */
class OverwriteFlexForm
{
    /**
     * @var string
     */
    protected $path = 'FILE:EXT:t3up/Configuration/FlexForms/flexform_mediaalbum.xml';

    /**
     * @return void
     */
    public function overwrite()
    {
        $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['fsmediagallery_mediagallery,list'] =  $this->path;
    }
}