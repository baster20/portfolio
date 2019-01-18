/* WINDOW LOAD EVENTS */

jQuery(window).on('load', function () {
    "use strict";
    jQuery("body").find('#site-loading').fadeOut(500);
    jQuery("body").find('#site-loading-css').fadeOut(500);
    jQuery(".blog-img").each(function () {
        if (jQuery(this).attr('data-image')) {
            jQuery(this).backstretch(jQuery(this).data('image'), {
                fade: 500
            });
        }
    });
});

/* SUBMENU */

jQuery('#cv-sidebar').find(".cv-submenu ul > li > a").on('click', function () {
    "use strict";
    var nxt = jQuery(this).next();
    if ((nxt.is('ul')) && (nxt.is(':visible'))) {
        nxt.slideUp(300);
        jQuery(this).removeClass("cvdropdown2").addClass("cvdropdown");
    }
    if ((nxt.is('ul')) && (!nxt.is(':visible'))) {
        jQuery('#cv-sidebar').find('.cv-submenu ul ul:visible').slideUp(300);
        nxt.slideDown(100);
        jQuery('#cv-sidebar').find('.cv-submenu > ul > li:has(ul) > a').removeClass("cvdropdown2").addClass("cvdropdown");
        jQuery(this).addClass("cvdropdown2");
    }
    if (nxt.is('ul')) {
        return false;
    } else {
        return true;
    }
});

/* SIDEBAR DROPDOWN MENU */

jQuery('#cv-sidebar').find(".widget_nav_menu > div > ul > li > a").on('click', function () {
    "use strict";
    var nxt = jQuery(this).next();
    if ((nxt.is('ul')) && (nxt.is(':visible'))) {
        nxt.slideUp(300);
        jQuery(this).removeClass("cvdropdown2").addClass("cvdropdown");
    }
    if ((nxt.is('ul')) && (!nxt.is(':visible'))) {
        jQuery('#cv-sidebar').find('.widget_nav_menu > div ul ul:visible').slideUp(300);
        nxt.slideDown(100);
        jQuery('#cv-sidebar').find('.widget_nav_menu > div > ul > li:has(ul) > a').removeClass("cvdropdown2").addClass("cvdropdown");
        jQuery(this).addClass("cvdropdown2");
    }
    if (nxt.is('ul')) {
        return false;
    } else {
        return true;
    }
});

/* SIDEBAR */

jQuery("body").find(".cv-menu-button").on("click", function (e) {
    "use strict";
    e.preventDefault();
    jQuery(this).toggleClass("rotate-menu-icon");
    jQuery("#cv-sidebar").toggleClass("open");
});

/* BACK TO TOP */

jQuery("#cv-back-to-top").on('click', function (event) {
    "use strict";
    event.preventDefault();
    jQuery('#cv-page-right').animate({
        scrollTop: 0
    }, 500);
});

/* ICON EFFECT */

jQuery('body').find(".cv-icon-container").on({
    mouseenter: function () {
        "use strict";
        jQuery(this).addClass('animated rubberBand');
    },
    mouseleave: function () {
        "use strict";
        jQuery(this).removeClass('animated rubberBand');
    }
});

/* OTHER EVENTS */

jQuery(document).ready(function () {
    "use strict"; 
    /* SIDEBAR CUSTOM SCROLLBAR */
    if (jQuery(window).width() > 1024) {
        jQuery("#cv-sidebar-inner").mCustomScrollbar({
            scrollInertia: 500,
            autoHideScrollbar: true,
            theme: "light-thick",
            scrollButtons: {
                enable: true
            },
            advanced: {
                updateOnContentResize: true
            }
        });
    }
    /* MENU SCROLLBAR */
    if (jQuery(window).width() > 1024) {
        jQuery("#cv-menu").mCustomScrollbar({
            scrollInertia: 0,
            autoHideScrollbar: true,
            theme: "light-thin",
            scrollButtons: {
                enable: true
            },
            advanced: {
                updateOnContentResize: true
            }
        });
    }
    
    /* ADD SUBMENU DROPDOWN ARROWS */
    jQuery('#cv-sidebar').find('.cv-submenu > ul > li:has(ul) > a').addClass("cvdropdown");
    jQuery('#cv-sidebar').find('.widget_nav_menu > div > ul > li:has(ul) > a').addClass("cvdropdown");
    
    /* SKILLS */
    jQuery("body").find('.skillbar').each(function () {
        jQuery(this).find('.skillbar-bar').width(jQuery(this).data('percent'));
    });
});