// This function takes in the coords of the farm, and creates a map object centered around that farm's coords
function createMap(farms) {
	var farm = farms[0];

	// create the map and load it into the div with id="objectMap"
	var objectMap = L.map('objectMap');

	// use the OpenStreetMaps tiles
	L.tileLayer(
		'https://a.tile.openstreetmap.org/{z}/{x}/{y}.png',
		{
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		}
	).addTo(objectMap); // add the tiles to the map object

	// center the map view around the farm
	objectMap.setView([farm.latitude, farm.longitude], 14);

	// adds marker to map
	createMarker(farm, objectMap);
}

// this function takes in the map object and adds a marker to it
function createMarker(farm, objectMap) {

	// create a map marker for the farm at the farm's coords
	L.marker([farm.latitude, farm.longitude])

		// add this marker to the map object
		.addTo(objectMap)

		// include a pop-up for the marker that contains the farm's name
		.bindPopup("<b>" + farm.farmName + "</b>")

		// set the popup to open when map is loaded
		.openPopup();
}