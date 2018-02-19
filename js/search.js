// Start the location delegate
function getLocation() {

	// if HTML5 geolocation exists
	if (navigator.geolocation) {

		// Need to show loader
		document.getElementById("spinner").style = "display:block";

		// Get the current position of the user, if successful call showPosition, if not successful showError
		navigator.geolocation.getCurrentPosition(showPosition, showError);
		
	} else { // If HTML5 geolocation does not exist
		document.getElementById("geoResults").innerHTML = "Geolocation is not supported by this browser.";
	}
}

// Show the user's position
function showPosition(position) {

	// Grab user's location and return it
	findFarmsNearMe(position.coords.latitude, position.coords.longitude);
}

// Show error to user
function showError(error) {

	// Need to hide loader
	document.getElementById("spinner").style = "display:none";

	switch(error.code) {
		case error.PERMISSION_DENIED:
			document.getElementById("geoResults").innerHTML  = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			document.getElementById("geoResults").innerHTML  = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			document.getElementById("geoResults").innerHTML  = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			document.getElementById("geoResults").innerHTML  = "An unknown error occurred."
			break;
	}
}

function findFarmsNearMe(lat, lon) {

	// Reset geo status
	document.getElementById("geoResults").innerHTML = "";

	// We are now going to create a form, add fields for lat and lon, and then submit the form to the back end
	var form = createFormElement();
	
	// creating and populating the latitude and longitude form fields
	var latitude = createFormNumberElement("latitude", lat);
	var longitude = createFormNumberElement("longitude", lon);	

	// appending the form fields to the form
	form.appendChild(latitude);
	form.appendChild(longitude);

	// appending the form to the body of the DOM
	document.getElementsByTagName('body')[0].appendChild(form);

	// Need to hide loader
	document.getElementById("spinner").style = "display:none";

	// submitting the form
	document.forms['coordsForm'].submit();	

	// once we have back end setup, we can then query all records and use the haversine function in order to find all farms within 50km (?) from the user
	// then we'll return direct the user to the results page and populate the table with this list
}

// Create s a form element
function createFormElement() {
	var form = document.createElement("form");
	form.setAttribute("name", "coordsForm");
	form.setAttribute("method", "get");
	form.setAttribute("action", "results_sample.html");

	// do not display form for when we add it to the DOM
	form.setAttribute("style", "display:none");
	return form;
}

// Creates a form number element
function createFormNumberElement(name, value) {
	var number = document.createElement("input");
	number.setAttribute("type", "number");
	number.setAttribute("name", name);
	number.setAttribute("value", value);
	return number;
}