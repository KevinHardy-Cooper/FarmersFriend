function validate(form) {	

	// check for empty required fields if HTML5 validation is not built into browser
	if (form.farm_name.value == "")	{
		document.getElementById("farm_name_status").innerHTML = "No farm name entered";
		return false;
	}
	if (form.farm_description.value == "") {
		document.getElementById("farm_descr_status") = "No description entered";
		return false;
	}
	if (form.farm_latitude.value == "") {
		document.getElementById("farm_lat_status") = "No latitude entered";
		return false;
	}
	if (form.farm_longitude.value == "") {
		document.getElementById("farm_lon_status") = "No longitude entered";
		return false;
	}

	// now we will check if the values entered are valid
	// farm name must contain at least one letter, some numbers, and the only special characters it can contain are ' and & and ,
	if (!validateFarmName(form.farm_name.value)) {
		document.getElementById("farm_name_status").innerHTML = "Invalid farm name";
	}

	if (!validateFarmDescription(form.farm_description.value)) {
		document.getElementById("farm_descr_status").innerHTML = "Invalid farm description";
	}

	// latitude must be a number, positive or negative, can be an integer or a double, and there is a max limit and a min limit
	if (!validateLatitude(form.farm_latitude.value)) {
		document.getElementById("farm_lat_status").innerHTML = "Invalid latitude";
	}

	// longitude is the same as latitude
	if (!validateLongitude(form.farm_longitude.value)) {
		document.getElementById("farm_lon_status").innerHTML = "Invalid longitude";
	}

	// after we have set the error messages, determine if the form should be submitted
	if (!validateFarmName(form.farm_name.value) || !validateFarmDescription(form.farm_description.value) || !validateLatitude(form.farm_latitude.value) || !validateLongitude(form.farm_longitude.value)) {
		document.getElementById("formStatus").innerHTML = "Cannot submit form";
		return false;
	}

	// after we have replaced special characters, set this new value to the value in the form
	// description requires no validation other than requires at least one letter, and a limit of 140 characters a la twitter
	form.farm_description.value = alterFarmDescription(form.farm_description.value);
	return true;
}

function validateFarmName(farmName) {

	// Must start with a letter, then followed by at least one letter.  If there is a space, apostrophe or hyphen, then it must be followed by at least one letter.  If there is a space, apostrophe or hyphen then there must be letters before these characters.
	var farmNamePattern = /^[A-Za-z][A-Za-z]+([ '-][A-Za-z]+)*$/;
	return farmNamePattern.test(farmName);
}

function validateFarmDescription(farmDescription) {

	// check that farm description is between 1 and 140 characters
	var farmDescriptionPattern = /^.{1,140}$/;
	return farmDescriptionPattern.test(farmDescription);
}

function alterFarmDescription(farmDescription) {
	
	// The form textarea field already has a maxlength set to 140 characters
	// Now we just need to validate that special characters are turned into unicode
	farmDescription = farmDescription.replace(/</g, "&lt;");
	farmDescription = farmDescription.replace(/>/g, "&gt;");
	farmDescription = farmDescription.replace(/"/g, "&quot;");
	farmDescription = farmDescription.replace(/'/g, "&apos;");
	farmDescription = farmDescription.replace(/!/g, "&#33;");
	farmDescription = farmDescription.replace(/@/g, "&#64;");
	farmDescription = farmDescription.replace(/#/g, "&#35;");
	farmDescription = farmDescription.replace(/$/g, "&#36;");
	farmDescription = farmDescription.replace(/%/g, "&#37;");
	farmDescription = farmDescription.replace(/^/g, "&#94;");
	farmDescription = farmDescription.replace(/&/g, "&amp;");
	return farmDescription;
}

function validateLatitude(farmLatitude) {
	if (farmLatitude > Number.MAX_SAFE_INTEGER || farmLatitude < ( -1  * Number.MAX_SAFE_INTEGER)) {
		document.getElementById("farm_lat_status").innerHTML = "Invalid latitude";
		return false;
	}
	return true;
}
function validateLongitude(farmLongitude) {
	if (farmLongitude > Number.MAX_SAFE_INTEGER || farmLongitude < (-1 * Number.MAX_SAFE_INTEGER)) {
		document.getElementById("farm_lon_status").innerHTML = "Invalid longitude";
		return false;
	}
	return true;
}

// place user coordinates as the farm lat and lon
function setCoords() {

	// once again, ask for location of user via html5 geoloaction
	getLocation();
}

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

	// Reset geo status
	document.getElementById("geoResults").innerHTML = "";

	// Need to hide loader
	document.getElementById("spinner").style = "display:none";

	// Grab user's location and return it
	document.getElementById("farm_latitude").value = position.coords.latitude; 
	document.getElementById("farm_longitude").value = position.coords.longitude;
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