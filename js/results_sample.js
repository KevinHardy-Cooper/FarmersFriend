// dummy array that will contain sample farms
var farmResults = [
	{
		farm: {
			name: "Farmer Kev's Farm",
			dateJoined: "January 8th, 2018",
			averageRating: "5.0 stars",
			latitude: 43.27,
			longitude: -79.921782,
			img: "assets/img/two-silos.jpg"
		}
	},
	{
		farm: {
			name: "Woodfield Farm & Market",
			dateJoined: "January 8th, 2018",
			averageRating: "5.0 stars",
			latitude: 43.260659,
			longitude: -79.921782,
			img: "assets/img/corn-field.jpeg"
		}
	},
	{
		farm: {
			name: "Maple Grove Farm",
			dateJoined: "January 8th, 2018",
			averageRating: "5.0 stars",
			latitude: 43.260659,
			longitude: -79.93,
			img: "assets/img/cow-calves.jpeg"
		}
	},
	{
		farm: {
			name: "Lit Farm",
			dateJoined: "January 8th, 2018",
			averageRating: "5.0 stars",
			latitude: 43.26,
			longitude: -79.92,
			img: "assets/img/truck-mountains.jpg"
		}
	},
];

// display search params
// TODO: take parameters that user searched for, and display them here
displaySearchParams(farmResults, "\"&#9734; &#9734; &#9734; &#9734; &#9734;\"");

// creates map element
createMap(farmResults);

// populating the table
populateTable(farmResults);


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

	// currently centered around mcmaster university
	// TODO will need to center around either top search result coords or where user is
	resultMap.setView([43.263,-79.919], 15);

	// iterating through array of coordinates for farms
	for (var farm in latLngArray) {

		// create a map marker for the farm
		L.marker([latLngArray[farm].farm.latitude, latLngArray[farm].farm.longitude])
					// add this marker to the map object
			.addTo(resultMap)

			// include a pop-up for the marker that contains a link to the farm's page, average rating, image of farm
			.bindPopup("<b><a href='individual_sample.html'>" + latLngArray[farm].farm.name + "</a></b>" + 
				"<br>" +
				latLngArray[farm].farm.averageRating + 
				"<br>" +
				"<img src='" + latLngArray[farm].farm.img + "' width='100px'/>");
	}
}

// This function displays the number of results, and the search parameters
// TODO: add another parameter since the maximum number of parameters can be 2
// TODO: add the appropriate display message when user searches for farms near them
function displaySearchParams(results, param1) {
	document.getElementById("searchParams").innerHTML = results.length + " results for " + param1;
}

// This function adds a row to the table for each farm given
function populateTable(farmResults) {

	// Get table object from DOM
	var table = document.getElementById("resultsTable");

	// For each farm index in farmReviews, do
	for (var farm in farmResults) {

		// Create a row given a farm
		var row = createRow(farmResults[farm].farm);

		// Add this row to the table
		table.appendChild(row);
	}
}


// Because we are dealing with more complex elements in the table data cells, this function will be a lot more complex than that in individual_sample.js
function createRow(farm) {

	// Create row object for DOM
	var row = document.createElement("tr");

	// Create img element to place in cell, add attributes
	var img = document.createElement("img");
	img.setAttribute("alt", "User-uploaded image of their farm");
	img.setAttribute("class", "results-image");

	// Set the src for this image to that contained within the farm JSON
	img.src = farm.img;

	// Create a new table data element.  We will not be using the createCell function since we don't want to set the innerHTML of the table data cell to an image
	var td = document.createElement("td");

	// Add the img element to the table data cell
	td.appendChild(img); 

	// Add this image cell to the row
	row.appendChild(td);

	// TODO: this href will change dynamically
	// This name string contains the anchor tag and farm name
	var name = "<a href = "+ "individual_sample.html" + ">" + farm.name + "</a>";

	// Create a cell using this name string
	var nameTd = createCell(name);

	// Add this name cell to the row
	row.appendChild(nameTd);

	// This is fairly straight forward.  Set string from JSON to innerHTML of data cell, then add to row
	var dateTd = createCell(farm.dateJoined);
	row.appendChild(dateTd);

	// Same as above
	var averageTd = createCell(farm.averageRating);
	row.appendChild(averageTd);

	// Create button element, set attributes, and content
	var button = document.createElement("button");
	button.setAttribute("class", "large-field");
	button.innerHTML = "Review";

	// Similar to that above with the image object, we are manually creating a table data cell and appending the button to the cell, then appending this cell to the row
	var buttonTd = document.createElement("td");
	buttonTd.appendChild(button);
	row.appendChild(buttonTd);

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