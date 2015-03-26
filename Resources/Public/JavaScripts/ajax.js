/**
 * Created by S3b0 on 25/03/15.
 */

(function($){
	/**
	 * Territory switch
	 */
	$('#t3locations-select-territory').on('change',function() {
		$('#t3locations-select-country').attr('disabled', 'disabled');
		$('#t3locations-select-country').find('option:not(:eq(0))').remove();
		if ( this.value != 0 ) {
			ajaxRequest('getData', {
				territory: this.value
			}, function ( result ) {
				if ( result.length ) {
					var regionSelect = $('#t3locations-select-country');
					regionSelect.removeAttr('disabled');
					for ( var key in result ) {
						regionSelect.append('<option value="' + result[key].uid + '">' + result[key].title + '</option>');
					}
				} else {
					$('#t3locations-select-country').attr('disabled', 'disabled');
					/*$('#product-data').html('<p class="alert alert-info"><i class="fa fa-info-circle fa-fw fa-lg"></i> ' + noRegionMsg + '</p>');*/
				}
			});
		}
	});

	/**
	 * Country switch
	 */
	$('#t3locations-select-country').on('change',function() {
		if ( this.value != 0 ) {
			ajaxRequest('getData', {
				region: this.value
			}, function ( result ) {
				var mapData = result['mapData'];
				$('#t3locations-ajax').html(result['html']);
				$('.t3locations-vcard').each(function() {
					var a = $(this).parent().height(),
						b = $(this).children('address').first().css('margin-top'),
						c = $(this).children('address').first().css('margin-bottom'),
						d= a - parseInt(b) - parseInt(c);
					$(this).height(a);
					$(this).children('address').first().css({height : d + 'px'});
				});
				if ( result['addMapCanvas'] ) {
					initializeMap(mapData);
				}
			});
		}
	});

	$('#t3locations-select-territory').val('');
	$('#t3locations-select-country').attr('disabled', 'disabled');
})(jQuery);

function ajaxRequest(action, arguments, onSuccess) {
	$('#t3locations-ajax-indicator').css('display', 'inline-block');
	$.ajax({
		async: 'true',
		url: 'index.php',
		type: 'POST',
		//contentType: 'application/json; charset=utf-8',
		dataType: 'json',
		data: {
			eID: 't3locations',
			id: parseInt(pid),
			L: parseInt(langUid),
			type: 1427289984,
			request: {
				controllerName: 'JsonRequest',
				actionName: action,
				arguments: arguments
			}
		},
		success: onSuccess,
		complete: function() {
			$('#t3locations-ajax-indicator').hide();
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log('Request failed with ' + textStatus + ': ' + errorThrown +  '!');
		}
	});
}