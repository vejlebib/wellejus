/**
 * Creates the top-bar toggle menu.
 * 
 * Modified version of ddbasic.topbar.menu.js for wellejus theme
 */
(function($) {
  "use strict";

  /**
   * Toggle the search form from the top-bar menu.
   *
   * @param bool open
   *   If true we want to open the form and link else we want to close it.
   */
  function ddbasic_search(open) {
    if (open) {
      // If the user clicked the active link, close it instead.
      if ( $('.topbar-menu .leaf .topbar-link-search').hasClass('active') ) {
        $('.topbar-menu .leaf .topbar-link-search').toggleClass('active');
        $('.js-topbar-search').css("display", "none");
      } else {
        // Display the element.
        $('.topbar-menu .leaf .topbar-link-search').toggleClass('active');
        $('.js-topbar-search').css("display", "block");
      }
    } else {
      $('.topbar-menu .leaf .topbar-link-search').removeClass('active');
      $('.js-topbar-search').css("display", "none");
    }
  }

  /**
   * Toggle the mobile menu from the top-bar menu.
   *
   * @param bool open
   *   If true we want to open the form and link else we want to close it.
   */
  function ddbasic_mobile_menu(open) {
    if (open) {
      // If the user clicked the active link, close it instead.
      if ( $('.topbar-menu .leaf .topbar-link-menu').hasClass('active') ) {
        $('.topbar-menu .leaf .topbar-link-menu').toggleClass('active');
        $('.site-header .js-topbar-menu').css("display", "none");
      } else {
        // Display the element.
        $('.topbar-menu .leaf .topbar-link-menu').toggleClass('active');
        $('.site-header .js-topbar-menu').css("display", "block");
      }
    } else {
      $('.topbar-menu .leaf .topbar-link-menu').removeClass('active');
      $('.site-header .js-topbar-menu').css("display", "none");
    }
  }

  /**
   * Toggle the user login form from the top-bar menu.
   *
   * @param bool open
   *   If true we want to open the form and link else we want to close it.
   */
  function ddbasic_user_login(open) {
    if (open) {
      // If the user clicked the active link, close it instead.
      if ( $('.topbar-menu .leaf .topbar-link-user').hasClass('active') ) {
        $('.topbar-menu .leaf .topbar-link-user').toggleClass('active');
        $('.js-topbar-user').css("display", "none");
      } else {
        // Display the element.
        $('.topbar-menu .leaf .topbar-link-user').toggleClass('active');
        $('.js-topbar-user').css("display", "block");
      }
    } else {
      $('.topbar-menu .leaf .topbar-link-user').removeClass('active');
      $('.js-topbar-user').css("display", "none");
    }
  }

  /**
   * Toggle the user menu when logged in
   *
   * @param bool open
   *   If true we want to open the form and link else we want to close it.
   */
  function ddbasic_user_account(open) {
    if (open) {
      // If the user clicked the active link, close it instead.
      if ( $('.topbar-menu .leaf .topbar-link-user-account').hasClass('active') ) {
        $('.topbar-menu .leaf .topbar-link-user-account').toggleClass('active');
        $('.js-user-top-menu').css("display", "none");
      } else {
        // Display the element.
        $('.topbar-menu .leaf .topbar-link-user-account').toggleClass('active');
        $('.js-user-top-menu').css("display", "block");
      }
    } else {
      $('.topbar-menu .leaf .topbar-link-user-account').removeClass('active');
      $('.js-user-top-menu').css("display", "none");
    }
  }

  /**
   * Toggle the open hours block from the top-bar menu.
   *
   * @param bool open
   *   If true we want to open the form and link else we want to close it.
   */
  function wellejus_openhours(open) {
    if (open) {
      // If the user clicked the active link, close it instead.
      if ( $('.topbar-menu .leaf .topbar-link-hours').hasClass('active') ) {
        $('.topbar-menu .leaf .topbar-link-hours').toggleClass('active');
        $('.js-topbar-hours').css("display", "none");
      } else {
        // Display the element.
        $('.topbar-menu .leaf .topbar-link-hours').toggleClass('active');
        $('.js-topbar-hours').css("display", "block");
      }
    } else {
      $('.topbar-menu .leaf .topbar-link-hours').removeClass('active');
      $('.js-topbar-hours').css("display", "none");
    }
  }

  /**
   * Menu handling.
   *
   */
  function wellejus_menu_handling() {
    // Open search as default on frontpage, close on others.
    // By default open search on all pages if topbar is not displayed
    ( $('.topbar-menu').css("display") == "none" ) ? $('.js-topbar-search').css("display", "block"): $('.js-topbar-search').css("display", "none");
    $('.front .js-topbar-search').css("display", "block");
    
    // By default open user login on all pages if topbar is not displayed, 
    // else hide user login on load.
    ( $('.topbar-menu').css("display") == "none" ) ? $('.js-topbar-user').css("display", "block"): $('.js-topbar-user').css("display", "none");
    
    // If the search link is clicked toggle mobile menu and show/hide search.
    $('.js-topbar-link.topbar-link-search').on('click touchstart', function(e) {
      ddbasic_search(true);
      ddbasic_mobile_menu(false);
      ddbasic_user_login(false);
      ddbasic_user_account(false);
      wellejus_openhours(false);
      e.preventDefault();
    });
    
    // If the user login is clicked toggle user, show/hide user menu and show/hide openhours.
    $('.js-topbar-link.topbar-link-user').on('click touchstart', function(e) {
      ddbasic_user_login(true);
      ddbasic_mobile_menu(false);
      ddbasic_search(false);
      wellejus_openhours(false);
      e.preventDefault();
    });

    // If the user login is clicked toggle user, show/hide user menu and show/hide openhours.
    $('.js-topbar-link.topbar-link-user-account.default-override').on('click touchstart', function(e) {
      ddbasic_user_account(true);
      ddbasic_mobile_menu(false);
      ddbasic_search(false);
      wellejus_openhours(false);
      e.preventDefault();
    });
    
    //Hide openhours on load.
    $('.js-topbar-hours').css("display", "none");

    // Set active classes on menu.
    $('.front .leaf .topbar-link-menu').removeClass('active');
    $('.front .leaf .topbar-link-search').addClass('active');

    // If the mobile menu is clicked toggle search, show/hide menu and show/hide openhours.
    $('.js-topbar-link.topbar-link-menu').on('click touchstart', function(e) {
      ddbasic_mobile_menu(true);
      ddbasic_search(false);
      ddbasic_user_login(false);
      ddbasic_user_account(false);
      wellejus_openhours(false);
      e.preventDefault();
    });

    // If the openhours link is clicked toggle mobile menu, show/hide search, and show/hide user.
    $('.js-topbar-link.topbar-link-hours').on('click touchstart', function(e) {
      wellejus_openhours(true);
      ddbasic_search(false);
      ddbasic_mobile_menu(false);
      ddbasic_user_login(false);
      ddbasic_user_account(false);
      e.preventDefault();
    });

    /**
     * Add news category menu as sub-menu to news in main menu
     */

    if ($(".sub-menu-wrapper").length > 0) {
      $(".sub-menu-wrapper > .sub-menu").clone().appendTo('.main-menu > .active-trail');

      // Switch a few classes for style purposes.
      $(".main-menu .sub-menu a").addClass('menu-item');
      $(".main-menu .sub-menu").addClass('main-menu');
      $(".main-menu .sub-menu").removeClass('sub-menu');

      // The old menu is hidden by css on minor media queries.
    }

    /**
     * Adds library menu above content on local library pages.
     */
    if ($(".library-menu").length > 0) {
      // Move/copy the  library menu.
      $(".library-menu").clone().insertAfter('.primary-content .ding-library-image');

      //Change add selection markup and fix the classes.
      $(".primary-content .library-menu").addClass('js-library-menu-responsive');
      $(".primary-content .library-menu").removeClass('library-menu');
      $(".js-library-menu-responsive .links").wrap("<select></select>");
      $(".js-library-menu-responsive .links").removeClass('links');
      $(".js-library-menu-responsive select li").wrap("<option class='select-item'></option>");
      $(".js-library-menu-responsive select .select-item").unwrap();
      // Move a href to select value.
      $(".primary-content .js-library-menu-responsive select .select-item").each(function() {
        $ (this).attr("value", function() {
          return $(this).find("a").attr("href");
        });
      });
      // Now that path is preserved remove the li and a tags.
      $(".primary-content .js-library-menu-responsive select li a").unwrap();
      $(".primary-content .js-library-menu-responsive select a").replaceWith(function() {
        // Return the stripped text of the link.
        return $(this).contents();
      });
    };
  }

  /**
   * When ready start the magic and handle the menu.
   */
  $(document).ready(function () {
    wellejus_menu_handling();
    
    // Goto action.
    $(".js-library-menu-responsive select").change(function () {
      document.location.href = $(this).val();
    });
    
    // Move openhours block to the header if the topbar menu is not present
    if ( $('.topbar-menu').css("display") == "none" ) {
      $(".openhours-today-wrapper").appendTo($(".topbar-inner"));
    }
  });
  
  /**
   * Resetting menu if resizing
   */
  $( window ).resize(function() {
    
    // display all relevant elements if the topbar menu is not present
    if ( $('.topbar-menu').css("display") == "none" ) {
      // Resetting: open search and user
      $('.js-topbar-search').css("display", "block");
      $('.site-header .js-topbar-menu').css("display", "none");
      $('.js-topbar-user').css("display", "block");
      $('.js-user-top-menu').css("display", "block");
      $('.js-topbar-hours').css("display", "none");
    }
  }); 
  
})(jQuery);
