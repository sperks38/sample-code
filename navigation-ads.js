(function($) {
  $(window).bind('load', function() {
    $('.nice-menu > li').each(function(index) {
      if ($(this).hasClass('menuparent')) {
        $(this).attr('data-ad-target',$(this).children('a').text().toLowerCase().replace(/ /g, '-'));
        var linkURL = $(this).attr('data-ad-target');
        var oldWidth = $(this).children('div').width();
        var adWidth = $('.ad' + linkURL + ' .adPadding a').width();
        newWidth = oldWidth + adWidth + 20;
        if (adWidth > 1) {
          $(this).children('div').width(newWidth).prepend($('.ad' + linkURL + ' .adPadding a').css('width',adWidth));
        }
        $('.ad' + linkURL).closest('.block').remove();
      }
    });
  });
})(jQuery);
