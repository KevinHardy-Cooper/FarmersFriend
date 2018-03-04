// Uses the user's position in order to send it correctly to findFarmsNearMe
function positionAction(position) {
	findFarmsNearMe(position.coords.latitude, position.coords.longitude);
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
	form.setAttribute("action", "../php/results_sample.php");

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