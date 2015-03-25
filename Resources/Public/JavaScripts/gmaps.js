/**
 * Created by sebo on 08.01.15.
 */

function initializeMap(mapData) {
	// console.log('initialize started');
	google.maps.visualRefresh = true;
	var bounds = new google.maps.LatLngBounds();
	var marker = []; // new google.maps.Marker()
	var infowindow = []; // new google.maps.InfoWindow()
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
			// Extend Marker Class for fetching index
			marker[this[2]].getIndex = function(){return this.index;};
			console.log(this);
			infowindow[this[2]] = new google.maps.InfoWindow({
				content: '<p><strong>' + this[4] + '</strong> <span style="font-size:.9em">(' + this[9] + ')</span><br />' + this[5] + '<br /><a href="' + this[7] + '" target="_blank">' + this[8] + '</a></p>'
			});
			// infowindow[businessmgmtmaps[i].uid].open(map,marker[businessmgmtmaps[i].uid]); // initially open info window
			google.maps.event.addListener(marker[this[2]], 'click', function() {
				infowindow[this.getIndex()].open(map,this);
			});
			infowindow[this[2]].open(map,marker[this[2]]);
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

(function($) {
	if (typeof mapData != 'undefined') {
		initializeMap(mapData);
	}
})(jQuery);