// This function takes in an array that will be used for coordinates
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
	
	if (latLngArray.length == 0) {
		// If no results, center around McMaster University and return 
		resultMap.setView([43.2609, -79.9192], 13);
		return;
	} else {
		resultMap.setView([latLngArray[0].latitude, latLngArray[0].longitude], 13);
	}

	// iterating through array of coordinates for farms
	for (var farm in latLngArray) {

		var ratingString;
		// this case will occur when a farm is added but no one has reviewed it yet
		if ((typeof latLngArray[farm].averageRating) === 'object') {
			ratingString = "Not yet reviewed";
		} else {
			ratingString = latLngArray[farm].averageRating + " stars";
		}

		// create a map marker for the farm
		L.marker([latLngArray[farm].latitude, latLngArray[farm].longitude])
					// add this marker to the map object
			.addTo(resultMap)

			// include a pop-up for the marker that contains a link to the farm's page, average rating, image of farm
			.bindPopup("<b><a href='../dynamic/individual_page.php?farm=" + latLngArray[farm].farmID + "'>" + latLngArray[farm].name + "</a></b>" + 
				"<br>" +
				ratingString + 
				"<br>" +
				"<img src='../" + latLngArray[farm].imagePath + "' width='100px'/>");
	}
}