// dummy array that will contain lats and lngs of farms
var latLngArray = [[43.260659, -79.921782], [43.27, -79.921782], [43.260659, -79.93]];

// creates map element
createMap(latLngArray);

function createMap(latLngArray) {

	// create the map and load it into the div with id="resultMap"
	var resultMap = L.map('resultMap');

	// use the OpenStreetMaps tiles
	L.tileLayer(
		'https://a.tile.openstreetmap.org/{z}/{x}/{y}.png',
		{
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		}
	).addTo(resultMap); // add the tiles to the map object

	// currently centered around mcmaster university
	// TODO will need to center around either top search result coords or where user is
	resultMap.setView([43.263,-79.919], 15);

	// iterating through array of coordinates for farms
	for (var farm in latLngArray) {

		// create a map marker for the farm
		L.marker(latLngArray[farm])
					// add this marker to the map object
			.addTo(resultMap)

			// include a pop-up for the marker that contains a link to the farm's page
			.bindPopup("<b><a href='individual_sample.html'>Sample Page</a></b>");
	}
}