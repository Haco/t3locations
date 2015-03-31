/**
 * Created by sebo on 03.02.15.
 */

function toggleFieldsReq(e, data) {
	switch ( data[1] ) {
		case '>':
			$(data[0]).val() > data[2] ? e.show() : e.hide();
			break;
		case '>=':
			$(data[0]).val() >= data[2] ? e.show() : e.hide();
			break;
		case '<':
			$(data[0]).val() < data[2] ? e.show() : e.hide();
			break;
		case '<=':
			$(data[0]).val() <= data[2] ? e.show() : e.hide();
			break;
		case '!=':
			$(data[0]).val() != data[2] ? e.show() : e.hide();
			break;
		default :
			$(data[0]).val() == data[2] ? e.show() : e.hide();
	}
}

function updateForm(form) {
	if ( confirm('This change will affect which fields are available in the form.\nWould you like to save now in order to refresh the display?') ) {
		form.redirect.value = 'edit';
		form.submit();
	} else {
		return false;
	}
}

(function($) {
	$('.t3locations-vcard').each(function() {
		var a = $(this).parent().height(),
			b = $(this).children('address').first().css('margin-top'),
			c = $(this).children('address').first().css('margin-bottom'),
			d= a - parseInt(b) - parseInt(c);
		$(this).height(a);
		$(this).children('address').first().css({height : d + 'px'});
	});
	$('.typo3-messages').each(function() {
		$(this).delay(500).fadeOut();
	});
	$('.t3loc-req').each(function() {
		var data = $(this).data('t3loc-req').split(':'),
			el = $(this);
		if ( (data[0].substr(0,5) === 'input' || data[0].substr(0,6) === 'select' || data[0].substr(0,8) === 'textarea') && $(data[0]) ) {
			$(data[0]).on('change', null, [el, data], function(event) {
				toggleFieldsReq(event.data[0], event.data[1]);
			});
			toggleFieldsReq($(this), data);
		}
	});
})(jQuery);