/**
 * Modified version of the ddbasic.search.js for the Wellejus theme.
 */

(function($) {
  "use strict";

  $(document).ready(function() {
    if (window.location.href.indexOf("search/") > -1) {
      // Remove tabs (panels visibility rules do not work!).
      $('.pane-page-tabs').remove();
    }
  });
}(jQuery));
