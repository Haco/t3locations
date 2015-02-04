/**
 * Created by sebo on 03.02.15.
 */

(function($) {
	$('.t3locations-vcard').each(function() {
		var a = $(this).parent().height(),
			b = $(this).children('address').first().css('margin-top'),
			c = $(this).children('address').first().css('margin-bottom'),
			d= a - parseInt(b) - parseInt(c);
		$(this).height(a);
		$(this).children('address').first().css({height : d + 'px'});
	});
})(jQuery);