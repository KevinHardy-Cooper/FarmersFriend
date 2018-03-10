// dummy array that will contain sample farms
// var farmResults = [
// 	{
// 		farm: {
// 			name: "Farmer Kev's Farm",
// 			dateJoined: "January 8th, 2018",
// 			averageRating: "5.0 stars",
// 			latitude: 43.27,
// 			longitude: -79.921782,
// 			img: "../assets/img/two-silos.jpg"
// 		}
// 	},
// 	{
// 		farm: {
// 			name: "Woodfield Farm & Market",
// 			dateJoined: "January 8th, 2018",
// 			averageRating: "5.0 stars",
// 			latitude: 43.260659,
// 			longitude: -79.921782,
// 			img: "../assets/img/corn-field.jpeg"
// 		}
// 	},
// 	{
// 		farm: {
// 			name: "Maple Grove Farm",
// 			dateJoined: "January 8th, 2018",
// 			averageRating: "5.0 stars",
// 			latitude: 43.260659,
// 			longitude: -79.93,
// 			img: "../assets/img/cow-calves.jpeg"
// 		}
// 	},
// 	{
// 		farm: {
// 			name: "Lit Farm",
// 			dateJoined: "January 8th, 2018",
// 			averageRating: "5.0 stars",
// 			latitude: 43.26,
// 			longitude: -79.92,
// 			img: "../assets/img/truck-mountains.jpg"
// 		}
// 	},
// ];

// This function takes in an array that will be used for coordinates
function createMap(latLngArray) {
	console.log(latLngArray);

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

		// create a map marker for the farm
		L.marker([latLngArray[farm].latitude, latLngArray[farm].longitude])
					// add this marker to the map object
			.addTo(resultMap)

			// include a pop-up for the marker that contains a link to the farm's page, average rating, image of farm
			.bindPopup("<b><a href='../dynamic/individual_page.php?farm=" + latLngArray[farm].farmID + "'>" + latLngArray[farm].name + "</a></b>" + 
				"<br>" +
				latLngArray[farm].averageRating + " stars" + 
				"<br>" +
				"<img src='../" + latLngArray[farm].imagePath + "' width='100px'/>");
	}
}