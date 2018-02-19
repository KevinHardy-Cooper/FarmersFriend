// dummy array that will contain lats and lngs of farms
var farmLatLng = [43.260659, -79.921782];

// dummy data to populate sample page
var farmName = "Farmer Kev's Farm";
var farmDescr = "Hobby farm that sells free-range eggs and more than enough swiss chard.";
var farmAvRating = "Average Rating: 5 stars";

// dummy array that will contain sample reviews
var farmReviews = [
	{
		review: {
			content: "Wow so great",
			date: "January 9th, 2018",
			rating: "5 stars",
			reviewer: "Not Not Farmer Kev"
		}
	},
	{
		review: {
			content: "Great so wow",
			date: "January 10th, 2018",
			rating: "5 stars",
			reviewer: "Not Not Not Not Farmer Kev"
		}
	},
	{
		review: {
			content: "Gee whiz I loves me their pork tenderloin!!!",
			date: "January 9th, 2018",
			rating: "5 stars",
			reviewer: "The Neighbour"
		}
	},
	{
		review: {
			content: "OMG THIS FARM IS SO QUAINT",
			date: "January 9th, 2018",
			rating: "5 stars",
			reviewer: "Citiot"
		}
	},
];

// creates map element
createMap(farmLatLng);

// setting information for the farm onto the page
setFarmInfo(farmName, farmDescr, farmAvRating, farmLatLng);

// populating the table
populateTable(farmReviews);

// dummy array that will contain lats and lngs of farms
var farmLatLng = [43.260659, -79.921782];


// This function takes in the coords of the farm, and creates a map object centered around that farm's coords
function createMap(farmLatLng) {

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
	objectMap.setView(farmLatLng, 14);

	// adds marker to map
	createMarker(objectMap);
}

// this function takes in the map object and adds a marker to it
function createMarker(objectMap) {

	// create a map marker for the farm at the farm's coords
	L.marker(farmLatLng)

		// add this marker to the map object
		.addTo(objectMap)

		// include a pop-up for the marker that contains the farm's name
		.bindPopup("<b>" + farmName + "</b>")

		// set the popup to open when map is loaded
		.openPopup();
}

// This function takes in the farm information and displays it on the page
function setFarmInfo(farmName, farmDescr, farmAvRating, farmLatLng) {
	document.getElementById("farm_name").innerHTML = farmName;
	document.getElementById("description").innerHTML = farmDescr;
	document.getElementById("farm_coords").innerHTML = "Coordinates: " + farmLatLng;
	document.getElementById("farm_av_rating").innerHTML = farmAvRating;
}

// This function adds a row to the table for each review given
function populateTable(farmReviews) {

	// Get table object from DOM
	var table = document.getElementById("reviewTable");

	// For each review index in farmReviews, do
	for (var review in farmReviews) {

		// Create a row given a review
		var row = createRow(farmReviews[review].review);

		// Add this row to the table
		table.appendChild(row);
	}
}

// This function adds a cell to the row for each key in a review
function createRow(review) {

	// Create row object for DOM
	var row = document.createElement("tr");

	// For each key in the review JSON do
	for (var key in review) {

		// Create a cell given a key in the JSON
		var td = createCell(review[key]);

		// Add this cell to the row
		row.appendChild(td);
	}

	// Return the row containing the review values
	return row;
}

// This function creates a cell and sets it's content
function createCell(content) {

	// Create cell object for DOM 
	var td = document.createElement("td");

	// Set content of cell to parameter
	td.innerHTML = content;

	// Return filled in cell
	return td;
}