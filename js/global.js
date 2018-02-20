// Start the location delegate
function getLocation() {

	// if HTML5 geolocation exists
		if (navigator.geolocation) {

			// Need to show loader
		document.getElementById("spinner").style = "display:block";

			// Get the current position of the user, if successful call showPosition, if not successful showError
		navigator.geolocation.getCurrentPosition(positionAction, showError);
		
	} else { // If HTML5 geolocation does not exist
		document.getElementById("geoResults").innerHTML = "Geolocation is not supported by this browser.";
	}
}

// Show error to user
function showError(error) {

	// Need to hide loader
	document.getElementById("spinner").style = "display:none";

	// Depending on the error sent via Geolocation, the error message will be different
	switch(error.code) {
		case error.PERMISSION_DENIED:
			document.getElementById("geoResults").innerHTML  = "If you don't want us to use your location, then don't click a feature that requires location."
			break;
		case error.POSITION_UNAVAILABLE:
			document.getElementById("geoResults").innerHTML  = "Your location is currently unavailable."
			break;
		case error.TIMEOUT:
			document.getElementById("geoResults").innerHTML  = "The request to get your location has timed out."
			break;
		default:
			document.getElementById("geoResults").innerHTML  = "An unknown error has occurred."
			break;			
	}
}