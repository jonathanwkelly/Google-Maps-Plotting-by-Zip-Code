$(document).ready(function(){

	var map = new GMap2($("#map").get(0));
	map.addControl(new GLargeMapControl3D());
	map.setMapType(G_PHYSICAL_MAP);
	var zoom = 4;
	var markers = new Array();
	var newCenter = new GLatLng(37.095962,-95.273437);
	map.setCenter(newCenter, zoom);
	var mapControl = new GMapTypeControl();
	map.addControl(mapControl);

	var baseIcon = new GIcon();
	baseIcon.image = "./location-icon.png";
	baseIcon.shadow = "./location-icon-shadow.png";
	baseIcon.iconSize = new GSize(21, 33);
	baseIcon.shadowSize = new GSize(43, 30);
	baseIcon.iconAnchor = new GPoint(10, 33);
	baseIcon.infoWindowAnchor = new GPoint(10, 10);
	baseIcon.infoShadowAnchor = new GPoint(10, 10);

	// Creates a marker whose info window displays the letter corresponding to the given index.
	function createMarker(point, index) {

		// Set up our GMarkerOptions object
		markerOptions = { icon:baseIcon };
		var marker = new GMarker(point, markerOptions);
		GEvent.addListener(marker, "click", function() {
			marker.openInfoWindowHtml("Marker information");
		});
		
		return marker;
	}

	// Get an array containing all the zip codes for the locations, so we can plot them
	$.each(MapLocations, function(index, value) {
		if(value['lat']) {
			var latlng = new GLatLng(value['lat'], value['long']);
			map.addOverlay(createMarker(latlng, value['entryid']));
		}
	});

});