/*********************************************
 * Script to reveal ads as they render and remove empty ads (doubleclick delivers a 1x1 gif for empty ads)
 * 
 *********************************************/

jQuery(function($) {
  $(window).load(function() {
    $('.block-pm_doubleclick').each(function() {
      var width = $(this).find('.adPadding img, .adPadding object, .adPadding iframe, .adPadding embed').width();
      $(this).addClass('ad-on ad' + width);
    });

    $('.ad1:has(img[src$="-grey.gif"])').addClass('ad-off'); // removes empty ads (accounts for ads using pixel tracking)

    /*
    * Check to see if the article 180 ad is empty AND there is no other visible
    * content. If so, hide the whole div region. 
    */
    if ($('.pm-node-region').children(':visible').length === 0) {
      $('.pm-node-region').hide();
    };
  });
});

/*********************************************
 * scripts for the display of a interstitial
 * advertisement (errantly referred to as roadblock)
 *********************************************/
(function(jQuery) {
  jQuery.fn.extend({ 
  //This is where you write your plugin's name
    ShowRoadblockAd: function(options) {

      // set the default values
      var defaults = {
        windowSize : 800,
        backgroundColor : "#fff",
        clickID : "closeRB",
        countID : "rc",
        startCount : 15,
        opacity : '0.7'
      };
      var options = jQuery.extend(defaults, options);

      // create iframe divshim and set style elements
      var divShim = jQuery("#DivShim")
      divShim.css({
        'position': 'fixed',
        'border': '0',
        'top' : '0px',
        'left' : '0px',
        'z-index': '999997',
        'display': 'none',
        'height': '100%',
        'width' : '100%',
        'background-color' : 'transparent'
      });

      // create overlay background
      var rbBackground = jQuery("#roadblockbackground");
      rbBackground.css({
        'display' : 'block',
        'opacity' : options.opacity,
        'background-color' : options.backgroundColor,
        'position' : 'fixed',
        'width' : '100%',
        'height' : '100%',
        'top' : '0px',
        'left' : '0px',
        'z-index' : '999998'
      });

      // show the div shim and background - hide the iframe in IE
      document.body.className +=' hideVideo';
      if(!jQuery.browser.msie) {
        divShim.show();
        rbBackground.show();
      }

      //Iterate over the current set of matched elements
      return this.each(function() {
        var o = options;
        var obj = jQuery(this);

        // get window width and height
        var wHeight = jQuery(window).height();
        var wWidth = jQuery(window).width();

        // get the center position for the window
        var top = 50; //(wHeight / 2) - (options.windowSize / 2);
        var left = (wWidth / 2) - (options.windowSize / 2);

        // set center position
        obj.css({
          position : 'fixed',
          left : left + 'px',
          top : top + 'px',
          width : options.windowSize + 'px',
          height : options.windowSize + 'px',
          'z-index' : '999999'
        }).show();

        var reveal = function() {
          // remove all the overlays
          document.body.className = document.body.className.replace(' hideVideo', '');
          obj.hide();
          rbBackground.hide();
          divShim.hide();
          return false;
        }
    
        // to be executed when page loads
        $(document).ready(function() {
          // enable close click to close the window
          jQuery('#'+options.clickID+' a', obj).click(reveal);

          // set the stat count so we know it has the right value
          jQuery('#'+options.countID).css("display", "inline").html(options.startCount);

          // start the counter
          setTimeout(function() {
            var counter = jQuery('#'+options.countID);
            var clock = counter.html();
            clock = clock - 1;
            counter.html(clock);
            if (clock == 0) {
              reveal();
              return;
            }
            setTimeout(arguments.callee, 1000);
          }, 1000);
        });
      });
    }
  });
  //This is a plugin to refresh doubleclick ad that appear in an IFrame (ex Gallery).
  jQuery.fn.extend({
    pm_doubleclick_refreshIframes: function() {
      // loop through each iFrame every time you click on a link and set the source of the iFrame to itself.
      var $ord = Math.floor(Math.random() * 10000000);
      jQuery.each($(this), function() {
        var $newLocation = $(this).attr("src").replace(/&ord=[0-9]+/g, "&ord="+$ord);
        this.contentWindow.location.replace($newLocation);
      });
    }
  });
})(jQuery);
