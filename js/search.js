/**
 * File: search.js 
 * Author: Kevin Hardy-Cooper
 * Date: March 20, 2018
 * ABSTRACT: Contains methods for searching based on the user's position
 */

// Massages the user's position in order to send it correctly to findFarmsNearMe
function positionAction(position) {
	findFarmsNearMe(position.coords.latitude, position.coords.longitude);
}

// create top secret form containing the user's location and submits it
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
}

// Create s a form element
function createFormElement() {
	var form = document.createElement("form");
	form.setAttribute("name", "coordsForm");
	form.setAttribute("method", "post");
	form.setAttribute("action", "../dynamic/delegate/close_farms_page.php");

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