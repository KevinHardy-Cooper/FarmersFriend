/**
 * File: map.js 
 * Author: Kevin Hardy-Cooper
 * Date: March 20, 2018
 * ABSTRACT: Contains methods for displaying objects on map via OpenStreetMaps API
 */

// This function takes in the coords of the farm, and creates a map object containing the resulting farm(s)
function createMap(farms, mapDiv) {

	// create the map and load it into the div with id = mapDiv
	var resultMap = L.map(mapDiv);

	// use the OpenStreetMaps tiles
	L.tileLayer(
		'https://a.tile.openstreetmap.org/{z}/{x}/{y}.png',
		{
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		}
	).addTo(resultMap); // add the tiles to the map object

	// set the center of the map view
	setView(farms, resultMap);

	// will contain the value to be loaded into the map marker popup
	var popUpString = "";

	// due to the sql query that was made to retrieve all reviews for an individual farm, this causes
	// the farms array to appear to contain multiple farms when in fact it is just duplicates of the same farm
	// We need to first check if more than one farm exists in the array and then check if the farms array contains 
	// duplicate farmIDs.  If so, then take advantage of javascript and set the length parameter to 1
	if (farms.length > 1 && farms[0].farmID == farms[1].farmID) {
		farms.length = 1;
	}

	// If there are no farms, then return 
	if (farms.length == 0) {
		return;
	} else if (farms.length == 1) {

		// if there is only one farm, then set the popup content appropriately for the page
		popUpString = setPopUpContent(farms, 0, "");

		// display the one marker for the farm
		createMarker(farms[0], resultMap, popUpString);
	} else {

		// if there is more than one farm, then iterate through array for farms
		for (var farm in farms) {

			// Will contain the text to indicate if the farm has been rated yet
			var ratingString = determineRatingMessage(farms[farm]);

			// if there is more than one farm, then set the popup content appropriately for the page
			popUpString = setPopUpContent(farms, farm, ratingString);

			// adds marker to map
			createMarker(farms[farm], resultMap, popUpString);
		}
	}
}


// set the content of the popup
function setPopUpContent(farms, index, ratingString) {

	// if there is only one farm, then we just want the popup to contain the farm name
	if (farms.length == 1) {
		return "<b>" + farms[index].farmName + "</b>";
	} else {

		// if there is more than one farm, then we want the popup to contain the farm name (with a link), 
		// the average rating of the farm and an image of the farm
		return "<b><a href='../../dynamic/delegate/individual_page.php?farm=" + farms[index].farmID + "'>" + farms[index].name + "</a></b>" + 
			"<br>" + ratingString + "<br>" +
			"<img src='../../" + farms[index].imagePath + "' width='100px'/>";
	}
}

// set the message for the farm rating
function determineRatingMessage(farm) {

	// this case will occur when a farm is added but no one has reviewed it yet
	if ((typeof farm.averageRating) === 'object') {
		return "Not yet reviewed";
	} else {

		// if farm has been reviewed, display appropriately
		return farm.averageRating + " stars";
	}
}


// centers view of map to specific point based on number of farms returned
function setView(farms, resultMap) {

	// If no results, center around McMaster University
	if (farms.length == 0) {
		resultMap.setView([43.2609, -79.9192], 14);
	} else {

		// center the map view around the top farm
		resultMap.setView([farms[0].latitude, farms[0].longitude], 14);
	}	
}

// this function takes in the map object and adds a marker to it
function createMarker(farm, resultMap, popUpString) {

	// create a map marker for the farm at the farm's coords
	L.marker([farm.latitude, farm.longitude])

		// add this marker to the map object
		.addTo(resultMap)

		// include a pop-up for the marker that contains the farm's name
		.bindPopup(popUpString);
}