$(document).ready(function() {
    
	const $body = $("body");
    const $nav = $(".nav");
    const $plu = unescape("+");
    const $min = unescape("–");
    const $pluTop = unescape("+");
    const $minTop = unescape("–");
        
    
    let maxSubItems = 0;
    
    const toggleAria = ($elem, isExpanded) => {
      $elem.attr({
        'aria-hidden': String(!isExpanded),
        'aria-expanded': String(isExpanded)
      });
    };
    
    const resetSiblings = ($item) => {
      $item.siblings().each(function() {
        const $sib = $(this);
        toggleAria( $sib.find('.subnav'), false );
        $sib.attr('data-show-sub','false').removeClass('activated');
        $sib.find('li').removeClass('activated');
        $sib.find('.box').hide();
      });
    };
    
    const resMenu = () => {
      if ($(window).width() >= 992) {
        $('#menu .subnav').each(function(){
          toggleAria($(this), false);
        });
        $('#menu li').attr('data-show-sub','false').removeClass('activated');
        $('#menu .subnav span.nextlevel').text($plu);
        $('.box, .submenulevel, .overlay').fadeOut('fast');
      }
    };

    $(window).bind('scroll', function () {
        $('#menu .subnav').each(function(){
            toggleAria($(this), false);
         });
        $('#menu li').attr('data-show-sub','false').removeClass('activated');
        $('#menu .subnav span.nextlevel').text($plu);
        $('.box, .submenulevel, .overlay').fadeOut('fast');
    });
    
    $(function() {
      // 1. Span-Text setzen & "lastitem" markieren
      $('#menu ul ul li:has(.subnav) span.nextlevel').text($plu);
      $('.nav li').last().addClass('lastitem');
    
      // 2. Wrap für activeNav
      $('.activeNav #menu > .nav > li > .row').wrap('<div class="box"><div class="container px-0 px-lg-3"></div><span class="btn-close"></span></div>');
    
      // 3. Max Sublevels bestimmen
      $('#menu ul ul, #menu ul ul ul, #menu ul ul ul ul').each(function(){
        maxSubItems = Math.max(maxSubItems, $(this).children().length);
      });
    
      const liHeight = $('.subnav > li').height();
      const blockNavHeight = liHeight * maxSubItems;
    
      // 4. Overlay‑Farbe steuern
      $body.on('focus touchend click mouseover', '#menu > ul > li', function() {
        const $li = $(this);
        if ($li.parent().is('.nav')) {
          const cl = ['turquoise','green','blue','red','grey','violett','orange']
                        .find(c => $li.hasClass(c));
          if (cl) $('.overlay').attr('class', `overlay ${cl}`);
        }
      });
      
      // 5. Reset Events
      $body.on('click touchend', '.btn-close, .overlay, .closelink', resMenu);
      $body.on('focus mouseenter click', '.logo', resMenu);
    });
    
    $body.on('click', '.navitem > span', function(e) {
        
        if ($(this).text($plu)) {
            $(this).text($min);
        } 

    });
    
    // StandardNav
    $body.on('click touchend', '.standardNav .navlink', function(e) {
      const $link = $(this), $li = $link.parent();
    
      resetSiblings($li.find('> .subnav').length ? $li : $li);
      
      if ($link.next().length && $li.parent().is('.nav')) {
        e.preventDefault();
        $('.overlay').fadeIn();
        $li.addClass('activated').attr('data-show-sub','true');
        $li.find('> span.nextlevel').text($minTop);
        toggleAria($li.find('> .subnav'), true);
      } else {
        $li.find('> span.nextlevel').text($min);
      }
    });
    
    // ActiveNav    
    $body.on('click touchend', '.activeNav .navlink', function(e) {
      const $link = $(this), $li = $link.parent();
    
      resetSiblings($li);
      if ($link.hasClass('show')) {
        resMenu();
        e.preventDefault();
      } else if ($link.next().length && $li.parent().is('.nav')) {
        e.preventDefault();
        $('.overlay').fadeIn();
        $li.addClass('activated').attr('data-show-sub','true');
        $li.find('> span.nextlevel').text($minTop);
        const $box = $li.find('.box').first();
        toggleAria($box.find('>.subnav'), true);
        $box.fadeIn('fast', () =>
          $li.siblings().find('.box').hide()
        );
        $li.find('li.act, li.cur').each(function(){
          toggleAria($(this).children('.subnav'), true);
          $(this).children('span.nextlevel').text($min);
        });
      }
      $link.toggleClass('show');
    });
    
    // BlockNav
    $body.on('click touchend', '.blockNav .navlink', function(e) {
      const $link = $(this), $li = $link.parent();
    
      resetSiblings($li);
      if ($link.hasClass('show')) {
        resMenu();
        e.preventDefault();
      } else if ($link.next().length && $li.parent().is('.nav')) {
        e.preventDefault();
        $('.overlay').fadeIn();
        $li.addClass('activated').attr('data-show-sub','true');
        toggleAria($li.find('> .subnav'), true);
      }
      $link.toggleClass('show');
    });
    
    // Subnavigation 
    $body.on('click', '#menu .subnav .navitem > span.nextlevel', function() {
      const $span = $(this), $li = $span.parent();
      const isMin = $span.text() === $plu;
    
      $('#menu .subnav span.nextlevel').text($plu);
      $('#menu .subnav .subnav').each(function(){
        toggleAria($(this), false);
        $(this).parent().removeClass('activated');
      });
    
      if (!isMin) {
        $span.text($min);
        toggleAria($li.find('> .subnav'), true);
        $li.addClass('activated').attr('data-show-sub','true');
      }
    });
    
    // Tastatur        
    // TAB Key 9
    $body.on('keyup', '.navlink', function(event) {
        const $navlink    = $(this);
        const $navitem    = $navlink.parent();
        const $nav        = $navlink.closest('.nav');
    
        const isLastItem  = $navitem.hasClass('lastitem');
    
        // Taste: TAB
        if (event.keyCode === 9) {
            if (isLastItem) {
                resMenu();
            } else {
                // Reset
                $navitem
                    .siblings()
                    .removeClass('activated')
                    .attr('data-show-sub', 'false')
                    .find('.subnav')
                        .attr({ 'aria-hidden': 'true', 'aria-expanded': 'false' })
                    .end()
                    .find('li')
                        .removeClass('activated')
                    .end()
                    .find('.box')
                        .hide()
                    .end()
                    .find('.subnav li > span.nextlevel')
                        .text($plu);
    
                // Aktivieren des aktuellen Elements
                $navitem
                    .addClass('activated')
                    .attr('data-show-sub', 'true');
    
                $('.overlay').fadeIn();
    
                const $subnav = $navitem.find('> .subnav');
    
                if ($navitem.parent().is('.nav')) {
                    $navitem.find('.box').show();
                    $navitem.find('.box > .subnav').add($subnav)
                        .attr({ 'aria-hidden': 'false', 'aria-expanded': 'true' });
                } else {
                    $subnav.attr({ 'aria-hidden': 'false', 'aria-expanded': 'true' });
                    $navitem.find('> span.nextlevel').text($min);
                    $navitem.siblings().find('> span.nextlevel').text($plu);
                }
            }
        }
    
        // Taste: ESC
        if (event.keyCode === 27) {
            resMenu();
        }
    });

        
    $body.on('keydown', '.navlink', function(event) {
        const $navlink    = $(this);
        const $navitem    = $navlink.parent();
        const $nav        = $navlink.closest('.nav');
        const $parentitem = $navlink.closest('.navitem');
        const isTopLevel  = $navitem.parent().is('.nav');
    
        const showSubnav = ($item) => {
            $item.find('.box').show();
            $item.find('.box > .subnav, > .subnav').attr({ 'aria-hidden': 'false', 'aria-expanded': 'true' });
        };
    
        const hideSubnavs = ($container) => {
            $container.find('.box').hide();
            $container.find('.subnav').attr({ 'aria-hidden': 'true', 'aria-expanded': 'false' });
        };
    
        switch (event.keyCode) {
            case 39: // → Rechts
                if (isTopLevel) {
                    const $next = $parentitem.is(":last-child")
                        ? $nav.find('> .navitem:first-child')
                        : $parentitem.next();
                    $next.children('.navlink').focus();
                    hideSubnavs($nav);
                } else {
                    const $subnav = $navitem.find('> .subnav');
                    $subnav.attr({ 'aria-hidden': 'false', 'aria-expanded': 'true' });
                    $navitem.find('> span.nextlevel').text($min);
                    $subnav.find('> .navitem:first-child > .navlink').focus();
                }
                event.preventDefault();
                break;
    
            case 37: // ← Links
                if (isTopLevel) {
                    const $prev = $parentitem.is(":first-child")
                        ? $nav.find('> .navitem:last-child')
                        : $parentitem.prev();
                    $prev.children('.navlink').focus();
                    hideSubnavs($nav);
                } else {
                    const $currentSubnav = $navlink.closest('.subnav');
                    const $parentNavItem = $currentSubnav.parent('.navitem');
                    const $parentLink    = $parentNavItem.children('.navlink');
            
                    // Untermenü verstecken
                    $parentNavItem.find('> .box').hide(); // ← WICHTIG!
                    $currentSubnav.attr({ 'aria-hidden': 'true', 'aria-expanded': 'false' });
                    $parentNavItem.find('> span.nextlevel').text($plu);
            
                    // Fokus zurück auf Parent
                    $parentLink.focus();
                }
                event.preventDefault();
                break;
    
            case 40: // ↓ Pfeil runter
                if (isTopLevel) {
                    showSubnav($navitem);
                    $navitem.find('> .subnav > .navitem:first-child > .navlink').focus();
                } else {
                    const $nextItem = $navitem.is(":last-child")
                        ? $navitem.parent().parent().closest('li').children('.navlink')
                        : $navitem.next().children('.navlink');
                    $nextItem.focus();
                }
                event.preventDefault();
                break;
    
            case 38: // ↑ Pfeil hoch
                if ($navitem.closest('.subnav').length) {
                    const $target = $navitem.is(":first-child")
                        ? $navitem.parent().parent().closest('li').children('.navlink')
                        : $navitem.prev().children('.navlink');
                    $target.focus();
                }
                event.preventDefault();
                break;
        }
    });

    
});
