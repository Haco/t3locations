/**
 * Created by sebo on 08.01.15.
 */

function initializeMap(mapData) {
	// console.log('initialize started');
	google.maps.visualRefresh = true;
	var bounds = new google.maps.LatLngBounds();
	var marker = []; // new google.maps.Marker()
	if (mapData.length > 0) {
		var mapOptions = getMapOptions(mapData[0], mapData[0][3]);
		map = new google.maps.Map($('#t3locations-map-canvas')[0], mapOptions);
		$.each(mapData.reverse(), function( index ) {
			var latLng = new google.maps.LatLng(this[0], this[1]);
			if ( !bounds.contains(latLng) ) {
				bounds.extend(latLng);
			}
			marker[this[2]] = new google.maps.Marker({
				map: map,
				draggable: false,
				/*animation: google.maps.Animation.DROP,*/
				position: latLng,
				title: this[4],
				index: this[2],
			});
		});
		if ( !bounds.isEmpty() && (bounds.toSpan().k !== 0 && bounds.toSpan().B !== 0) ) {
			map.setCenter(bounds.getCenter());
			if (mapData.length > 1) map.fitBounds(bounds, 'ff0000');
		}
	}
}

function getMapOptions(data, mapOptions) {
	/*console.log(mapOptions);*/
	var mapType = [
			google.maps.MapTypeId.ROADMAP,
			google.maps.MapTypeId.SATELLITE,
			google.maps.MapTypeId.HYBRID,
			google.maps.MapTypeId.TERRAIN
		],
		mapsMapTypeControlStyle = [
			google.maps.MapTypeControlStyle.DEFAULT,
			google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			google.maps.MapTypeControlStyle.HORIZONTAL_BAR
		],
		mapsControlPosition = [
			google.maps.ControlPosition.BOTTOM_CENTER,
			google.maps.ControlPosition.BOTTOM_LEFT,
			google.maps.ControlPosition.BOTTOM_RIGHT,
			google.maps.ControlPosition.LEFT_BOTTOM,
			google.maps.ControlPosition.LEFT_CENTER,
			google.maps.ControlPosition.LEFT_TOP,
			google.maps.ControlPosition.RIGHT_BOTTOM,
			google.maps.ControlPosition.RIGHT_CENTER,
			google.maps.ControlPosition.RIGHT_TOP,
			google.maps.ControlPosition.TOP_CENTER,
			google.maps.ControlPosition.TOP_LEFT,
			google.maps.ControlPosition.TOP_RIGHT
		],
		mapsZoomControlStyle = [
			google.maps.ZoomControlStyle.DEFAULT,
			google.maps.ZoomControlStyle.LARGE,
			google.maps.ZoomControlStyle.SMALL
		];

	return {
		backgroundColor: mapOptions[0],
		center: new google.maps.LatLng(data[0], data[1]),
		disableDoubleClickZoom: mapOptions[9][0],
		draggable: mapOptions[9][1],
		mapTypeControl: mapOptions[2],
		mapTypeControlOptions: {
			style: mapsMapTypeControlStyle[mapOptions[3]],
			position: mapsControlPosition[mapOptions[4]]
		},
		mapTypeId: mapType[mapOptions[1]],
		noClear: true,
		overviewMapControl: mapOptions[9][2],
		panControl: mapOptions[9][3],
		rotateControl: mapOptions[9][4],
		scaleControl: mapOptions[9][5],
		scrollwheel: mapOptions[9][6],
		streetViewControl: mapOptions[9][7],
		zoom: mapOptions[5],
		zoomControl: mapOptions[6],
		zoomControlOptions: {
			style: mapsZoomControlStyle[mapOptions[7]],
			position: mapsControlPosition[mapOptions[8]]
		}
	};
}


function initAjaxLoader(element, action) {
	if (action == 'add') {
		$(element).addClass('ajaxloader');
	} else {
		$(element).removeClass('ajaxloader');
	}
}

function resetForm(ids) {
	$(ids).attr('disabled', 'disabled');
	$(ids).find('option:not(:eq(0))').remove();
	$('#businessMgmtFormResult').html('');
}


(function($) {

	if (typeof mapData != 'undefined') {
		initializeMap(mapData);
	}

	$('#businessMgmtFormTerritory').on('change', function() {
		initAjaxLoader('#businessMgmtFormCountry', 'add');
		var territory = this.value;
		resetForm('#businessMgmtFormCountry');
		if (territory != 0) {
			$('.business-mgmt').css('cursor', 'wait');
			$.ajax({
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: 'eId=ecom_business_finder&tx_ecombusinessfinder_ajax[action]=getCountryList&tx_ecombusinessfinder_ajax[territory]=' + territory + '&type=472995900',
				success: function(result) {
					if (result['success'] === true) {
						initAjaxLoader('#businessMgmtFormCountry', 'remove');
						$('#businessMgmtFormCountry').html(result['content']).removeAttr('disabled');
					} else {
						console.log('Request failed!');
					}
					$('.business-mgmt').css('cursor', 'default');
				}
			});
		}
	});

	$('#businessMgmtFormCountry').on('change', function() {
		initAjaxLoader('#businessMgmtFormResult', 'add');
		var territory = $('#businessMgmtFormTerritory').val();
		var country = this.value;
		if (country != 0) {
			$('.business-mgmt').css('cursor', 'progress');
			$.ajax({
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: 'eId=ecom_business_finder&tx_ecombusinessfinder_ajax[action]=getBusinesses&tx_ecombusinessfinder_ajax[territory]=' + territory + '&tx_ecombusinessfinder_ajax[country]=' + country + '&type=472995901',
				success: function(result) {
					if (result['success'] === true) {
						initAjaxLoader('#businessMgmtFormResult', 'remove');
						$('#businessMgmtFormResult').html(result['content']);
						initializeMap(result['jsMapData']);
					} else {
						console.log('Request failed!');
					}
					$('.business-mgmt').css('cursor', 'default');
				}
			});
		} else {
			$('#businessMgmtFormResult').html('');
		}
	});

	$('#businessMgmtFormReset').on('click', function() {
		resetForm('#businessMgmtFormCountry');
		$('#businessMgmtFormTerritory').val(0);
	});

})(jQuery);