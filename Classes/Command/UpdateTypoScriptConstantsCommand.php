<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;

final class UpdateTypoScriptConstantsCommand extends Command
{
    protected static $defaultName = 't3up:update:constants';
    protected static $defaultDescription = 'Apply predefined TypoScript constant presets to sys_template (modes: default|up|imp)';

    // --------------------------- COLOR ---------------------------
    private const PRESET_COLOR_DEFAULT = [
        'page.color.baseColor' => '#265694',
        'page.color.baseContainerBgColor' => '',
        'page.color.bodyBgColor' => '#F2F2F2',
        'page.color.containerBgColor' => '',
        'page.color.footer1BgColor' => '#333333',
        'page.color.footer1LinkColor' => '#FAFAFA',
        'page.color.footer1LinkHoverColor' => '#FFFFFF',
        'page.color.footer1TextColor' => '#EEEEEE',
        'page.color.footer2BgColor' => '#CCCCCC',
        'page.color.footer2liBgColor' => '#FAFAFA',
        'page.color.footer3BgColor' => '#0A0A0A',
        'page.color.footer3LinkColor' => '#FFFFFF',
        'page.color.footer3LinkHoverColor' => '#DADADA',
        'page.color.footer3TextColor' => '#FFFFFF',
        'page.color.headerBgColor' => '#FFFFFF',
        'page.color.headerColor' => '#666666',
        'page.color.headerLinkColor' => '#454545',
        'page.color.headerLinkHoverColor' => '#333333',
        'page.color.light' => '#F8F9FA',
        'page.color.lightgrey' => '#DADADA',
        'page.color.link' => '#0056B3',
        'page.color.navLinkColor' => '#333333',
        'page.color.navLinkHoverColor' => '#000000',
        'page.color.pictureoverlay' => '#33333399',
        'page.color.pictureoverlayfunction' => 'active',
        'page.color.pictureoverlaytext' => '#FFFFFF',
        'page.color.primary' => '#007BFF',
        'page.color.secondary' => '#6C757D',
        'page.color.sideankercolorBg' => '#FFFFFF',
        'page.color.subnavLinkColor' => '#333333',
        'page.color.subnavLinkHoverColor' => '#000000',
        'page.color.tableHeaderColor' => '#FFFFFF',
        'page.color.topBgColor' => '#FFFFFF',
        'page.color.topBorderColor' => '',
        'page.color.topLinkColor' => '#454545',
        'page.color.topLinkHoverColor' => '#000000',
    ];
    
//    private const PRESET_COLOR_DEFAULT = [
//        'page.color.baseColor' => '',
//        'page.color.baseContainerBgColor' => '',
//        'page.color.baseLinkColor' => '',
//        'page.color.containerBgColor' => '',
//        'page.color.dark' => '#343A40',
//        'page.color.footer2BgColor' => '',
//        'page.color.light' => '#F8F9FA',
//        'page.color.lightgrey' => '',
//        'page.color.navLinkBorderWidth' => '',
//        'page.color.sideankercolorBg' => '',
//        'page.color.subnavLinkColor' => '#333333',
//        'page.color.subnavLinkHoverColor' => '#000000',
//        'page.color.success' => '',
//        'page.color.tableHeaderColor' => '#FFFFFF',
//        'page.color.topTextColor' => '',
//    ];

    /** PRESET-only or PRESET-different (us
     * e UP values)
     */
    private const PRESET_COLOR_UP = [
        'page.color.topTextColor' => '#FFFFFF',
        'page.color.baseColor' => '#3E183E',
        'page.color.bodyBgColor' => '#FFFFFF',
        'page.color.baseLinkColor' => '#346097',
        'page.color.lightgrey' => '#DADADA',
        'page.color.sideankercolorBg' => '#FFFFFF',
        'page.color.navLinkBorderWidth' => '0',
        'page.color.success' => '#83A23B',
        'page.color.danger' => '#9A2428',
        'page.color.footer1BgColor' => '#F2F2F3',
        'page.color.footer1LinkColor' => '#333333',
        'page.color.footer1LinkHoverColor' => '#000000',
        'page.color.footer1TextColor' => '#333333',
        'page.color.footer3BgColor' => '#F0F3F5',
        'page.color.footer3LinkColor' => '#333333',
        'page.color.footer3LinkHoverColor' => '#000000',
        'page.color.footer3TextColor' => '#333333',
        'page.color.h1-color' => '#3E183E',
        'page.color.headerBgColor' => '#FFFFFF',
        'page.color.headerColor' => '#666666',
        'page.color.headerLinkColor' => '#666666',
        'page.color.headerLinkHoverColor' => '#333333',
        'page.color.link' => '#346097',
        'page.color.navLinkColor' => '#333333',
        'page.color.navLinkHoverColor' => '#000000',
        'page.color.topBgColor' => '#3E183E',
        'page.color.topLinkColor' => '#FFFFFF',
        'page.color.topLinkHoverColor' => '#FFFFFF',
        'page.color.warning' => '#F9CA25',
    ];

    /** IMP-only or IMP-different (use IMP values) */
    private const PRESET_COLOR_IMP = [
        'page.color.h1-color' => '#FFFFFF',
        'page.color.success' => '#5CB85C',
        'page.color.bodyBgColor' => '#F3F3F3',
        'page.color.danger' => '#DC3545',
        'page.color.footer1BgColor' => '',
        'page.color.footer1LinkColor' => '#FFFFFF',
        'page.color.footer1LinkHoverColor' => '#FFFFFF',
        'page.color.footer1TextColor' => '#FFFFFF',
        'page.color.footer3BgColor' => '#151515',
        'page.color.footer3LinkColor' => '#FFFFFF',
        'page.color.footer3LinkHoverColor' => '#FFFFFF',
        'page.color.footer3TextColor' => '#FFFFFF',
        'page.color.headerBgColor' => '',
        'page.color.headerColor' => '#EFEFEF',
        'page.color.headerLinkColor' => '#FAFAFA',
        'page.color.headerLinkHoverColor' => '#FFFFFF',
        'page.color.link' => '#007BFF',
        'page.color.navLinkColor' => '#FFFFFF',
        'page.color.navLinkHoverColor' => '#FFFFFF',
        'page.color.primary' => '#007BFF',
        'page.color.secondary' => '#6C757D',
        'page.color.tableHeaderLineColor' => '#DADADA',
        'page.color.tableLineColor' => '#DADADA',
        'page.color.topBgColor' => '#32475B',
        'page.color.topLinkColor' => '#666666',
        'page.color.topLinkHoverColor' => '#333333',
        'page.color.totopBgColor' => '',
        'page.color.totopLinkColor' => '#FFFFFF',
        'page.color.totopLinkHoverColor' => '#FFFFFF',
        'page.color.warning' => '#FFC107',
    ];

    // ------------------------ TYPOGRAPHY -------------------------

    /** DEFAULT (present in both and identical) */
    private const PRESET_TYPOGRAPHY_DEFAULT = [
        'page.typography.h1' => '1.9',
        'page.typography.h1.fontweight' => '300',
        'page.typography.h1.lineheight' => '100%',
        'page.typography.h1.margin' => '$v1 $v050 $v2 !important',
        'page.typography.h2' => '1.3',
        'page.typography.h2.lineheight' => '120%',
        'page.typography.h2.margin' => '0 0 $v1 0',
        'page.typography.h2.fontweight' => '500',
        'page.typography.h3' => '0.9',
        'page.typography.h3.margin' => '0 0 $v090',
        'page.typography.h3.fontweight' => '500',
        'page.typography.h4.fontweight' => '600',
        'page.typography.h4' => '0.8',
        'page.typography.h4.margin' => '0 0 $v025',
        'page.typography.lineheight' => '135%',
        'page.typography.fontsize' => 'clamp(.9rem, 1.4rem, 1.2rem)',
    ];

    /** (use UP values) */
    private const PRESET_TYPOGRAPHY_UP = [
        'page.typography.h1.fontweight' => '400',
        'page.typography.h2' => '1.3',
        'page.typography.h2.lineheight' => '135%',
        'page.typography.h3' => '1.15',
        'page.typography.h3.lineheight' => '120%',
        'page.typography.h4' => '0.8',
        'page.typography.navigationfontsize' => '90%',
        'page.typography.h1' => '2',
        'page.typography.h1.wrap' => 'col-12 px-4 pb-4',
    ];

    /** IMP-only or IMP-different (use IMP values) */
    private const PRESET_TYPOGRAPHY_IMP = [
        'page.typography.h1' => '1.65rem',
        'page.typography.h1.fontweight' => '700',
        'page.typography.h1.lg' => '2.75rem',
        'page.typography.h1.md' => '2.05rem',
        'page.typography.h2.fontweight' => '600',
        'page.typography.p.md' => '1.05rem',
        'page.typography.p.lg' => '1.10rem',
        'page.typography.lineheight' => '1.8rem',
        'page.typography.boldweight' => '600',
    ];

    // -------------------------- FONTS -----------------------------

    /** DEFAULT: none */
    private const PRESET_FONTS_DEFAULT = [
        'page.fonts.font' => 'Open Sans',
        'page.fonts.fontpath' => '/Fonts/',
        'page.fonts.fontpath2' => '/Fonts/',
        'page.fonts.symbolfontpath' => '/Fonts/',
        'page.fonts.fontdef' => '../vendor/hda/t3up/Resources/Public/Sass',
        'page.fonts.symbol' => 'Material Symbols Sharp',
        'page.fonts.symbol2' => 'FontAwesome',
    ];

    private const PRESET_FONTS_UP = [
//        'page.fonts.fontdef' => '../vendor/hda/t3up/Resources/Public/Sass',
//        'page.fonts.symbol' => 'Material Symbols Sharp',
//        'page.fonts.symbol2' => 'FontAwesome',
//        'page.fonts.fontpath' => '/Fonts/',
    ];

    /** IMP-only or IMP-different -> IMP values (none provided) */
    private const PRESET_FONTS_IMP = [
        // none
    ];

    // -------------------------- OTHER CATEGORIES --------------------------
    // For all the other categories we keep the PRESET_UP (values from UP package).
    // DEFAULT arrays are empty (no IMP equal-values known), IMP arrays are empty for now.
    private const PRESET_FOOTER_DEFAULT = [
//        'page.footer.address' => 265,
        'page.footer.alumni' => 0,
        'page.footer.base' => 1,
//        'page.footer.contactpage' => 0,
        'page.footer.copyright' => 'h-da.de',
        'page.footer.dataprotection' => 10,
        'page.footer.disabilityaccess' => 0,
        'page.footer.footerBaseWrap' => '<div class="footer3"><div class="container"><div class="row justify-content-between px-3 py-3 pe-7 px-xxl-3">|</div></div></div>',
//        'page.footer.impress' => 6,
        'page.footer.lastchange' => 0,
        'page.footer.link' => 'www.h-da.de',
        'page.footer.monitoraddress' => 0,
//        'page.footer.pid' => 1,
//        'page.footer.service1' => 266,
//        'page.footer.service2' => 493,
//        'page.footer.service3' => 0,
//        'page.footer.sitemap' => 92,
        'page.footer.link' => 'htps://h-da.de',
    ];

    private const PRESET_FOOTER_UP = [
//        'page.footer.address' => '125891',
//        'page.footer.alumni' => '0',
//        'page.footer.base' => '1',
//        'page.footer.contactpage' => '0',
//        'page.footer.copyright' => 'h_da',
//        'page.footer.dataprotection' => '22571',
//        'page.footer.disabilityaccess' => '22572',
//        'page.footer.impress' => '22574',
//        'page.footer.link' => 'htps://h-da.de',
//        'page.footer.monitoraddress' => '0',
//        'page.footer.pid' => '1',
//        'page.footer.service1' => '125893',
//        'page.footer.service2' => '125894',
//        'page.footer.service3' => '125890',
        'page.footer.footerdynamic' => '0',
        'page.footer.footer1Wrap' => '<div class= "footer1"><div class= "container"><div class= "row px-4 py-sm-3 py-lg-4">|</div></div></div>',
//        'page.footer.footer' => '0',
        'page.footer.footerBaseWrap' => '<div class= "footer3"><div class= "container"><div class= "row justify-content-between py-3 px-6">|</div></div></div>',
        'page.footer.addressWrap' => '<div class= "col-12 col-sm-6 col-lg-3 ps-lg-3">|</div>',
        'page.footer.service1Wrap' => '<div class= "col-12 col-sm-6 col-lg-3 ps-lg-3">|</div>',
        'page.footer.service2Wrap' => '<div class= "col-12 col-sm-6 col-lg-3 ps-lg-3">|</div>',
    ];
    
    private const PRESET_FOOTER_IMP = [
//        'page.footer.address'          => 98,
//        'page.footer.base'             => 'active',
//        'page.footer.contactpage'      => 0,
//        'page.footer.copyright'        => 'h-da.de',
//        'page.footer.dataprotection'   => 707,
//        'page.footer.disabilityaccess' => 0,
//        'page.footer.impress'          => 15,
//        'page.footer.lastchange'       => '',
//        'page.footer.pid'              => '',
//        'page.footer.service1'         => 0,
//        'page.footer.service2'         => 0,
//        'page.footer.service3'         => 0,
    ];

    private const PRESET_HEADER_DEFAULT = [
//        'page.header.alttext' => 'Logo der HDA',
//        'page.header.alttextII' => 'EUROPEAN UNIVERSITY OF TECHNOLOGY',
        'page.header.dynheader' => 'fixed',
        'page.header.linklogoII' => 'https://www.univ-tech.eu/',
//        'page.header.logo' => 'EXT:hda/Resources/Public/Lg_eut/h_da_eut_lgo.svg',
        'page.header.logoIIwidth' => '100px',
        'page.header.logoIIwrap' => '<div class="logoII d-inline-block ms-auto my-auto pe-3">|</div>',
        'page.header.logostickywidth' => '66%',
        'page.header.logowrap' => '<div class="logo d-none d-md-inline-block col-3 px-3 py-3 ">|</div>',
        'page.header.mobillogo' => 'EXT:hda/Resources/Public/Lg_eut/h_da_eut_mobil-lgo.svg',
        'page.header.area' => 'd-flex flex-wrap justify-content-end',
        'page.header.headcontainer' => 'container d-flex justify-content-between',
    ];
    
//    private const PRESET_HEADER_DEFAULT = [
////        'page.header.alttext' => 'Home - Communiteach',
//        'page.header.dynheader' => 'fixed',
//        'page.header.headcontainer' => 'container d-flex',
////        'page.header.home' => '22556',
////        'page.header.languagemenu' => '',
////        'page.header.logo' => 'EXT:hda/Resources/Public/Logos/comm-lgo.svg',
//        'page.header.logomaxLgwidth' => '200',
//        'page.header.logomaxMdwidth' => '200',
//        'page.header.logomaxwidth' => '160',
//        'page.header.logostickymaxwidth' => '60%',
//        'page.header.logowidth' => '300px',
//        'page.header.logowrap' => '<div class= "logo d-block col-3 pb-3 py-7 pe-6 ms-6 order-1">|</div>',
//    ];

    private const PRESET_HEADER_UP = [
//        'page.header.alttext' => 'Home - Communiteach',
//        'page.header.dynheader' => 'fixed',
//        'page.header.headcontainer' => 'container d-flex',
//        'page.header.home' => '22556',
//        'page.header.languagemenu' => '',
//        'page.header.logo' => 'EXT:hda/Resources/Public/Logos/comm-lgo.svg',
//        'page.header.logomaxLgwidth' => '200',
//        'page.header.logomaxMdwidth' => '200',
//        'page.header.logomaxwidth' => '160',
//        'page.header.logostickymaxwidth' => '60%',
//        'page.header.logowidth' => '300px',
//        'page.header.logowrap' => '<div class= "logo d-block col-3 pb-3 py-7 pe-6 ms-6 order-1">|</div>',

    ];
    
    private const PRESET_HEADER_IMP = [
        'page.header.homebutton'       => '',
        'page.header.infobutton'       => 0,
//        'page.header.loginpage'        => 0,
//        'page.header.logo'             => 'typo3conf/ext/hda_magazin/Resources/Public/Design/impact.svg',
//        'page.header.logoutform'       => 0,
        'page.header.logowrap'         => '<div class="logo d-none d-lg-block col-3 my-auto p-3">|</div>',
//        'page.header.mobillogo'        => 'typo3conf/ext/hda_magazin/Resources/Public/Design/impact_mobile.svg',
        'page.header.mobillogowrap'    => '<div class="col-6 d-lg-none weblogo p-3">|</div>',
        'page.header.preferencesbutton'=> 0,
        'page.header.quicklinks'       => 0,
//        'page.header.searchpage'       => 22,
        'page.header.solrpage'         => 0,
        'page.header.logomaxwidth'     => 280,
        'page.header.logomaxMdwidth'   => 280,
        'page.header.logomaxLgwidth'   => 280,
//        'page.header.alttext'          => 'Impact',
        'page.header.logoIImaxwidth'   => 400,
    ];

    private const PRESET_NAVIGATION_DEFAULT = [
        'page.navigation.burgerAnkerExtra' => '0',
        'page.navigation.maxitems' => '20',
        'page.navigation.maxlevels' => '6',
        'page.navigation.navwrap' => 'mt-auto',
        'page.navigation.sideAnker' => '0',
        'page.navigation.style' => '2',
        'page.navigation.navdir' => 'justify-content-end',
    ];
    
    private const PRESET_NAVIGATION_UP = [
//        'page.navigation.burgerAnkerExtra' => '0',
//        'page.navigation.navwrap' => 'mt-auto order-2',
//        'page.navigation.style' => '2',
//        'page.navigation.subnavlevel' => '2',
//        'page.navigation.maxlevels' => '3',
//        'page.navigation.linkpadding' => '$v015 $v1 $v1 $v1',
    ];
    
    private const PRESET_NAVIGATION_IMP = [
//        'page.navigation.container' => 'container align-items-center py-lg-3',
    ];

    private const PRESET_TOP_DEFAULT = [];
    
    private const PRESET_TOP_UP = [
        'page.top.darkmodepos' => '3',
        'page.top.fontsizepos' => '2',
        'page.top.homebuttonpos' => '1',
        'page.top.infobutton' => '0',
        'page.top.loginbuttonpos' => '4',
//        'page.top.loginpage' => '22890',
        'page.top.mobilbottonpos' => '20',
        'page.top.searchbuttonpos' => '10',
//        'page.top.searchpage' => '22943',
        'page.top.searchpos' => '9',
    ];
    
    private const PRESET_TOP_IMP = [
        'page.top.darkmode'     => 'active',
        'page.top.languagemenu' => 3,
        'page.top.loginpage'    => 0,
        'page.top.searchpage'   => 18,
        'page.top.showtitle'    => 0,
        'page.top.top10'        => '',
        'page.top.top2'         => '',
        'page.top.top3'         => '',
        'page.top.top4'         => '',
        'page.top.top5'         => 'lib.header.searchpage',
        'page.top.top6'         => 'lib.header.darkmode',
        'page.top.top7'         => '',
        'page.top.top8'         => '',
        'page.top.top9'         => '',
        'page.top.topposition'  => '',
    ];

    private const PRESET_TOTOP_DEFAULT = [
        'page.totop.totopBgColor' => '#FFFFFF',
        'page.totop.totopLinkColor' => '#454545',
        'page.totop.totopLinkHoverColor' => '#000000',
        'page.totop.totopPosBottom' => '$v3',
    ];
    
    private const PRESET_TOTOP_UP = [
        'page.totop.totopBgColor' => '#FFFFFF',
        'page.totop.totopLinkColor' => '#333333',
        'page.totop.totopLinkHoverColor' => '#000000',
    ];
    
    private const PRESET_TOTOP_IMP = [];

    private const PRESET_SOCIAL_DEFAULT = [
        'page.socialmedia.email'     => 'info@h-da.de',
        'page.socialmedia.facebook'  => 'https://de-de.facebook.com/hochschuleda/',
        'page.socialmedia.hidelabel' => '',
        'page.socialmedia.instagram' => 'https://www.instagram.com/hochschuledarmstadt/',
//        'page.socialmedia.location'  => 0,
//        'page.socialmedia.login'     => 0,
        'page.socialmedia.pos'       => 'right',
//        'page.socialmedia.search'    => 0,
//        'page.socialmedia.ueberuns'  => 1055,
        'page.socialmedia.youtube'   => 'https://www.youtube.com/channel/UCSYGMjIiutDZ8ZfueCXFIpw',
    ];

    private const PRESET_SOCIAL_UP = [
//        'page.socialmedia.pos' => 'bottom',
//        'page.socialmedia.facebook' => 'xa.de',
//        'page.socialmedia.youtube' => 'eded.de',
//        'page.socialmedia.instagram' => 'deed.de',
//        'page.socialmedia.x' => 'deed.de',
//        'page.socialmedia.xing' => 'xing-kk.de',
//        'page.socialmedia.linkedin' => 'Linkedin.de',
//        'page.socialmedia.hidelabel' => 'd-inline-block',
//        'page.socialmedia.bluesky' => 'biiiiul.de',
//        'page.socialmedia.whatsapp' => 'biiiiul.de',
//        'page.socialmedia.socialsymbolfontsize' => '1.5rem',
//        'page.socialmedia.tiktok' => 'tiktik.de',
//        'page.socialmedia.search' => '0',
    ];
    
    private const PRESET_SOCIAL_IMP = [
        'page.socialmedia.email'     => 'info@h-da.de',
        'page.socialmedia.facebook'  => 'https://de-de.facebook.com/hochschuleda/',
        'page.socialmedia.hidelabel' => '',
        'page.socialmedia.instagram' => 'https://www.instagram.com/hochschuledarmstadt/',
//        'page.socialmedia.location'  => 0,
//        'page.socialmedia.login'     => 0,
        'page.socialmedia.pos'       => 'right',
//        'page.socialmedia.search'    => 0,
//        'page.socialmedia.ueberuns'  => 1055,
        'page.socialmedia.youtube'   => 'https://www.youtube.com/channel/UCSYGMjIiutDZ8ZfueCXFIpw',
    ];

    private const PRESET_BREADCRUMB_DEFAULT = [
        'page.breadcrumb.breadcrumbstart' => 'd-block',
        'page.breadcrumb.breadcrumbstyle' => '2',
        'page.breadcrumb.breadcrumbtext' => '1',
        'page.breadcrumb.breadcrumbwrap' => 'breadcrumbrow navbar navbar-expand-lg d-none d-lg-flex py-5 col-12 w-100',
    ];
//    private const PRESET_BREADCRUMB_DEFAULT = [];
    private const PRESET_BREADCRUMB_UP = [
        'page.breadcrumb.breadcrumbstyle' => '2',
        'page.breadcrumb.breadcrumbwrap' => 'breadcrumbrow navbar navbar-expand-lg d-none d-lg-flex pt-3 pb-6 px-6',
    ];
    private const PRESET_BREADCRUMB_IMP = [
        'page.breadcrumb.breadcrumbstyle' => '0',
    ];

    private const PRESET_COMPONENTS_DEFAULT = [
        'page.components.access' => 'access',
        'page.components.bootstrapdist' => 4,
        'page.components.mainpadding' => '0 0 $v2',
        'page.components.container' => '1400',
        'page.components.mobilmenu' => 'mmenu',
        'page.components.totop' => 'totop',
        // ggf. weitere Komponenten
        // 'page.files.subnavigation' => '0',
        // 'page.files.tablesorterstart' => 'active',
        // 'page.files.simpleAccordion' => '1',
    ];

    private const PRESET_COMPONENTS_UP = [
        'page.components.mainpadding' => '0 $v1 $v1',
        'page.components.contentpadding' => '0 $v1 $v1',
    ];
    private const PRESET_COMPONENTS_IMP = [
        'page.components.access'       => 'access',
        'page.components.bootstrapdist'=> 4,
        'page.components.container'    => 1260,
        'page.components.mobilmenu'    => 'mmenu',
        'page.components.totop'        => 'totop',
    ];

    private const PRESET_DESIGN_DEFAULT = [];
    private const PRESET_DESIGN_UP = [
        'page.design.columnSpacing' => '10',
        'page.design.rowSpacing' => '10',
        'page.design.borderPadding' => '10',
    ];
    private const PRESET_DESIGN_IMP = [];

    private const PRESET_CONFIG_DEFAULT = [
        'page.config.ExceptionHandler' => 0,
        'page.config.no_cache' => 1,
        'page.config.compressCss'      => 0,
        'page.config.compressJs'       => 0,
        'page.config.concatenateCss'   => 1,
        'page.config.concatenateJs'    => 1,
    ];

    private const PRESET_CONFIG_UP = [
        'page.config.ExceptionHandler' => '0',
    ];
    private const PRESET_CONFIG_IMP = [
        'page.config.ExceptionHandler' => 0,
        'page.config.compressCss'      => 0,
        'page.config.compressJs'       => 0,
        'page.config.concatenateCss'   => 1,
        'page.config.concatenateJs'    => 1,
        'page.config.no_cache'         => 0,
    ];

    private const PRESET_PLUGINS_DEFAULT = [
//        'plugin.tx_dpnglossary.persistence.storagePid' => '160',
    ];
    private const PRESET_PLUGINS_UP = [
//        'plugin.tx_hdacommuniteach.persistence.storagePid' => '22647',
//        'plugin.tx_hdadeepl.settings.glossaryPid' => '22959',

    ];
    private const PRESET_PLUGINS_IMP = [];

    private const PRESET_STYLES_DEFAULT = [
        'page.scss.hda' => 'active',
        'page.scss.scssfooter' => 'footer',
        'page.scss.scsssubnavigation' => 'subnavigation',
//        'styles.content.loginform.pid' => '2',
//        'styles.content.loginform.redirectPageLogout' => '1',
    ];
    private const PRESET_STYLES_UP = [
//        'styles.content.loginform.pid' => '6',
    ];
    private const PRESET_STYLES_IMP = [];

    /** ------------------ constructor ------------------ */
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:u:c'])
            ->addOption('uid', 'u', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'UID(s) of sys_template to update (can pass multiple)')
            ->addOption('category', 'c', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Category name(s) to apply')
            ->addOption('mode', 'm', InputOption::VALUE_OPTIONAL, 'Mode to run: default|up|imp', 'default')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Do not write to DB, only show what would change')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Force insertion of keys that do not exist (default: do NOT insert new keys)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $uids = $input->getOption('uid') ?: [];
        $categories = $input->getOption('category') ?: [];
        $dryRun = (bool)$input->getOption('dry-run');
        $force = (bool)$input->getOption('force');
        $mode = (string)$input->getOption('mode');

        // determine categories to operate on
        $allCategories = $this->allCategoryKeys();
        if (empty($categories)) {
            $categories = $allCategories;
            $output->writeln('<comment>No --category given — applying ALL categories: ' . implode(', ', $categories) . '</comment>');
        }

        // build pairs for selected categories according to mode
        $pairs = [];
        foreach ($categories as $cat) {
            $cat = (string)$cat;
            if (!in_array($cat, $allCategories, true)) {
                $output->writeln("<comment>Skipping unknown category '{$cat}'</comment>");
                continue;
            }

            $defaultConst = $this->getPresetDefaultByCategory($cat);
            $upConst = $this->getPresetUpByCategory($cat);
            $impConst = $this->getPresetImpByCategory($cat);

            if ($mode === 'default') {
                $pairs = array_merge($pairs, $defaultConst);
                $output->writeln("<comment>Category {$cat}: applying DEFAULT (" . count($defaultConst) . " keys)</comment>");
                continue;
            }

            if ($mode === 'up') {
                // DEFAULT + UP (UP values used)
                $pairs = array_merge($pairs, $defaultConst, $upConst);
                $output->writeln("<comment>Category {$cat}: applying DEFAULT + UP (" . (count($defaultConst) + count($upConst)) . " keys)</comment>");
                continue;
            }

            if ($mode === 'imp') {
                // DEFAULT + IMP (IMP values used)
                $pairs = array_merge($pairs, $defaultConst, $impConst);
                $output->writeln("<comment>Category {$cat}: applying DEFAULT + IMP (" . (count($defaultConst) + count($impConst)) . " keys)</comment>");
                continue;
            }
        }

        if (empty($pairs)) {
            $output->writeln('<comment>No key/value pairs to apply after building mode pairs.</comment>');
            return Command::SUCCESS;
        }

        // select templates (default root = 1)
        $conn = $this->connectionPool->getConnectionForTable('sys_template');
        $qb = $conn->createQueryBuilder()->select('uid', 'title', 'constants')->from('sys_template');
        if (!empty($uids)) {
            $qb->where($qb->expr()->in('uid', $qb->createNamedParameter($uids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)));
            $output->writeln('<comment>Selecting templates by UID: ' . implode(', ', $uids) . '</comment>');
        } else {
            $qb->where($qb->expr()->eq('root', $qb->createNamedParameter(1, ParameterType::INTEGER)));
            $output->writeln('<comment>Selecting templates with root = 1 (default).</comment>');
        }


        $templates = $qb->executeQuery()->fetchAllAssociative();
        if (empty($templates)) {
            $output->writeln('<comment>No templates matched the selection.</comment>');
            return Command::SUCCESS;
        }

        foreach ($templates as $template) {
            $uid = (int)$template['uid'];
            $title = $template['title'] ?? '(no title)';
            $existing = (string)$template['constants'];

            $output->writeln('');
            $output->writeln("<info>Template uid={$uid} — {$title}</info>");

            $mergeResult = $this->mergeConstants($existing, $pairs, $force);
            $newConstants = $mergeResult['new'];
            $skipped = $mergeResult['skipped'];
            $changed = $mergeResult['changed'];
            $added = $mergeResult['added'];

            if (!$changed) {
                $output->writeln('<comment>No changes necessary (no existing keys matched and --force not used).</comment>');
                if (!empty($skipped)) {
                    $output->writeln('<comment>Skipped keys (not present in template):</comment>');
                    foreach ($skipped as $k) {
                        // comment out if you want to see the exact changes, but otherwise it's too confusing.
//                        $output->writeln("  - {$k}");
                    }
                }
                continue;
            }

            $this->showPreviewDiff($existing, $newConstants, $output, $added);

            if ($dryRun) {
                $output->writeln('<comment>Dry run — not writing to DB.</comment>');
                if (!empty($skipped)) {
                    $output->writeln('<comment>Skipped keys (not present, required --force to insert):</comment>');
                    foreach ($skipped as $k) {
                        $output->writeln("  - {$k}");
                    }
                }
                continue;
            }

            $conn->update('sys_template', ['constants' => $newConstants], ['uid' => $uid]);
            $output->writeln('<info>Updated template in DB.</info>');
            if (!empty($skipped)) {
                $output->writeln('<comment>Skipped keys (not inserted):</comment>');
                foreach ($skipped as $k) {
                    $output->writeln("  - {$k}");
                }
            }
        }

        return Command::SUCCESS;
    }

    private function allCategoryKeys(): array
    {
        return [
            'color','typography','fonts','footer','header','navigation','top','totop','socialmedia',
            'breadcrumb','components','design','config','plugins','styles'
        ];
    }

    private function getPresetDefaultByCategory(string $category): array
    {
        return match (strtolower($category)) {
            'color' => self::PRESET_COLOR_DEFAULT,
            'typography' => self::PRESET_TYPOGRAPHY_DEFAULT,
            'fonts' => self::PRESET_FONTS_DEFAULT,
            'footer' => self::PRESET_FOOTER_DEFAULT,
            'header' => self::PRESET_HEADER_DEFAULT,
            'navigation' => self::PRESET_NAVIGATION_DEFAULT,
            'top' => self::PRESET_TOP_DEFAULT,
            'totop' => self::PRESET_TOTOP_DEFAULT,
            'socialmedia' => self::PRESET_SOCIAL_DEFAULT,
            'breadcrumb' => self::PRESET_BREADCRUMB_DEFAULT,
            'components' => self::PRESET_COMPONENTS_DEFAULT,
            'design' => self::PRESET_DESIGN_DEFAULT,
            'config' => self::PRESET_CONFIG_DEFAULT,
            'plugins' => self::PRESET_PLUGINS_DEFAULT,
            'styles' => self::PRESET_STYLES_DEFAULT,
            default => [],
        };
    }

    private function getPresetUpByCategory(string $category): array
    {
        return match (strtolower($category)) {
            'color' => self::PRESET_COLOR_UP,
            'typography' => self::PRESET_TYPOGRAPHY_UP,
            'fonts' => self::PRESET_FONTS_UP,
            'footer' => self::PRESET_FOOTER_UP,
            'header' => self::PRESET_HEADER_UP,
            'navigation' => self::PRESET_NAVIGATION_UP,
            'top' => self::PRESET_TOP_UP,
            'totop' => self::PRESET_TOTOP_UP,
            'socialmedia' => self::PRESET_SOCIAL_UP,
            'breadcrumb' => self::PRESET_BREADCRUMB_UP,
            'components' => self::PRESET_COMPONENTS_UP,
            'design' => self::PRESET_DESIGN_UP,
            'config' => self::PRESET_CONFIG_UP,
            'plugins' => self::PRESET_PLUGINS_UP,
            'styles' => self::PRESET_STYLES_UP,
            default => [],
        };
    }

    private function getPresetImpByCategory(string $category): array
    {
        return match (strtolower($category)) {
            'color' => self::PRESET_COLOR_IMP,
            'typography' => self::PRESET_TYPOGRAPHY_IMP,
            'fonts' => self::PRESET_FONTS_IMP,
            'footer' => self::PRESET_FOOTER_IMP,
            'header' => self::PRESET_HEADER_IMP,
            'navigation' => self::PRESET_NAVIGATION_IMP,
            'top' => self::PRESET_TOP_IMP,
            'totop' => self::PRESET_TOTOP_IMP,
            'socialmedia' => self::PRESET_SOCIAL_IMP,
            'breadcrumb' => self::PRESET_BREADCRUMB_IMP,
            'components' => self::PRESET_COMPONENTS_IMP,
            'design' => self::PRESET_DESIGN_IMP,
            'config' => self::PRESET_CONFIG_IMP,
            'plugins' => self::PRESET_PLUGINS_IMP,
            'styles' => self::PRESET_STYLES_IMP,
            default => [],
        };
    }

    /**
     * Merge / replace keys into existing TypoScript constants string.
     * - If a key exists (line starting with "key ="), replace that line.
     * - Otherwise: if $force === true, append "key = value" at the end; else skip and report.
     *
     * Returns array with keys: 'new' => merged string, 'skipped' => array of skipped keys, 'changed' => bool
     */
    private function mergeConstants(string $existing, array $pairs, bool $force): array
    {
        $lines = $existing === '' ? [] : preg_split('/\R/', $existing);
        $existingIndex = []; // key => line index
        foreach ($lines as $i => $line) {
            $trimmed = trim($line);
            if ($trimmed === '') {
                continue;
            }
            if (preg_match('/^([\w\.\[\]]+)\s*=\s*(.*)$/', $trimmed, $m)) {
                $key = $m[1];
                $existingIndex[$key] = $i;
            }
        }

        $skipped = [];
        $added = [];
        $changed = false;
        $toAppend = [];

        foreach ($pairs as $key => $value) {
            if (isset($existingIndex[$key])) {
                // replace in-place (preserve ordering)
                $idx = $existingIndex[$key];
                $oldLine = $lines[$idx];
                // capture old value
                if (preg_match('/^([\w\.\[\]]+)\s*=\s*(.*)$/', trim($oldLine), $m)) {
                    $oldValue = $m[2];
                } else {
                    $oldValue = null;
                }
                $newLine = $key . ' = ' . $value;
                if ($oldValue === null || (string)trim($oldValue) !== (string)$value) {
                    $lines[$idx] = $newLine;
                    $changed = true;
                }
            } else {
                if ($force) {
                    $toAppend[$key] = $value;
                    $added[] = $key;
                    $changed = true;
                } else {
                    $skipped[] = $key;
                }
            }
        }

        // append new keys (if any)
        if (!empty($toAppend)) {
            // ensure there's an empty line separator if original ended with content
            if (!empty($lines) && trim((string)end($lines)) !== '') {
                $lines[] = '';
            }
            foreach ($toAppend as $k => $v) {
                $lines[] = $k . ' = ' . $v;
            }
        }

        $new = implode(PHP_EOL, $lines);
        // keep final newline optional (not strictly necessary)

        return [
            'new'     => $new,
            'skipped' => $skipped,
            'changed' => $changed,
            'added'   => $added,
        ];
    }

    /**
     * Return all default keys from preset arrays (unique).
     */
    private function getAllDefaultKeys(): array
    {
        $all = array_merge(
            array_keys(self::PRESET_COLOR_DEFAULT),
            array_keys(self::PRESET_TYPOGRAPHY_DEFAULT),
            array_keys(self::PRESET_FONTS_DEFAULT),
            array_keys(self::PRESET_FOOTER_DEFAULT),
            array_keys(self::PRESET_HEADER_DEFAULT),
            array_keys(self::PRESET_NAVIGATION_DEFAULT),
            array_keys(self::PRESET_TOP_DEFAULT),
            array_keys(self::PRESET_TOTOP_DEFAULT),
            array_keys(self::PRESET_SOCIAL_DEFAULT),
            array_keys(self::PRESET_BREADCRUMB_DEFAULT),
            array_keys(self::PRESET_COMPONENTS_DEFAULT),
            array_keys(self::PRESET_DESIGN_DEFAULT),
            array_keys(self::PRESET_CONFIG_DEFAULT),
            array_keys(self::PRESET_PLUGINS_DEFAULT),
            array_keys(self::PRESET_STYLES_DEFAULT)
        );
        return array_unique($all);
    }

    /**
     * Show preview diff:
     * - red lines for old values (removed/changed)
     * - green lines for new values (added/changed)
     * - yellow lines for keys that were appended due to --force (added)
     *
     * $forceKeys = array of keys that were appended by mergeConstants (so they appear in yellow).
     */
    private function showPreviewDiff(
        string $old,
        string $new,
        OutputInterface $output,
        array $forceKeys = []
    ): void
    {
        $oldKV = $this->linesToKeyValue(trim($old));
        $newKV = $this->linesToKeyValue(trim($new));

        $defaultKeys = $this->getAllDefaultKeys();

        $allKeys = array_unique(array_merge(array_keys($oldKV), array_keys($newKV), $forceKeys));
        sort($allKeys);

        $changes = [];

        foreach ($allKeys as $key) {
            // ignore keys that are neither default nor forced
            if (!in_array($key, $defaultKeys, true) && !in_array($key, $forceKeys, true)) {
                continue;
            }

            $oldVal = array_key_exists($key, $oldKV) ? $oldKV[$key] : null;
            $newVal = array_key_exists($key, $newKV) ? $newKV[$key] : null;

            // forced additions (show yellow +)
            if (in_array($key, $forceKeys, true) && $oldVal === null && $newVal !== null) {
                $changes[] = ['type' => 'force', 'key' => $key, 'new' => $newVal];
                continue;
            }

            // changed values
            if ($oldVal !== null && $newVal !== null && $oldVal !== $newVal) {
                $changes[] = ['type' => 'change', 'key' => $key, 'old' => $oldVal, 'new' => $newVal];
                continue;
            }

            // newly added (not forced) — show green
            if ($oldVal === null && $newVal !== null) {
                $changes[] = ['type' => 'add', 'key' => $key, 'new' => $newVal];
                continue;
            }

            // removed (exists in old, not in new) — show red
            if ($oldVal !== null && $newVal === null) {
                $changes[] = ['type' => 'remove', 'key' => $key, 'old' => $oldVal];
                continue;
            }
        }

        if (empty($changes)) {
            $output->writeln('<comment>No visible changes detected (after filtering by defaults/force).</comment>');
            return;
        }

        $output->writeln('<info>Preview changes (old => new):</info>');
        foreach ($changes as $c) {
            if ($c['type'] === 'force') {
                $output->writeln(sprintf('  <fg=yellow;options=bold>+ %s = %s</>', $c['key'], $c['new']));
            } elseif ($c['type'] === 'change') {
                $output->writeln(sprintf('  <fg=red;options=bold>- %s = %s</>', $c['key'], $c['old']));
                $output->writeln(sprintf('  <fg=green;options=bold>+ %s = %s</>', $c['key'], $c['new']));
            } elseif ($c['type'] === 'add') {
                $output->writeln(sprintf('  <fg=green;options=bold>+ %s = %s</>', $c['key'], $c['new']));
            } elseif ($c['type'] === 'remove') {
                $output->writeln(sprintf('  <fg=red;options=bold>- %s = %s</>', $c['key'], $c['old']));
            }
        }
    }

    /**
     * Helper: turn constants text into key => value map (flat).
     */
    private function linesToKeyValue(string $text): array
    {
        if ($text === '') {
            return [];
        }
        $lines = preg_split('/\R/', $text);
        $result = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            if (preg_match('/^([\w\.\[\]]+)\s*=\s*(.*)$/', $line, $m)) {
                $key = $m[1];
                $value = $m[2];
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
