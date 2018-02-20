// This function is the main client-side validation delegate 
function validate(form) {	

	// This JSON contains the required fields and their respective messages
	var fieldStatuses = [
		{
			name: "farm_name_status",
			formValue: form.farm_name.value,
			emptyMessage: "No farm name entered",
			errorMessage: "Invalid farm name",
			successMessage: ""
		},
		{
			name: "farm_descr_status",
			formValue: form.farm_description.value,
			emptyMessage: "No farm description entered",
			errorMessage: "Invalid farm description",
			successMessage: ""	
		},
		{
			name: "farm_lat_status",
			formValue: form.farm_latitude.value,
			emptyMessage: "No latitude entered",
			errorMessage: "Invalid latitude",
			successMessage: ""	
		},
		{
			name: "farm_lon_status",
			formValue: form.farm_longitude.value,
			emptyMessage: "No longitude entered",
			errorMessage: "Invalid longitude",
			successMessage: ""
		},
	];

	// check for empty required fields if HTML5 validation is not built into browser
	for (var field in fieldStatuses) {
		document.getElementById(fieldStatuses[field].name).innerHTML = (fieldStatuses[field].formValue == "") ? fieldStatuses[field].emptyMessage : fieldStatuses[field].successMessage;
	}

	// now we check for valid field values 
	for (var field in fieldStatuses) {

		//if the validator returns invalid, display appropriately
		document.getElementById(fieldStatuses[field].name).innerHTML = (!validationFunctionForField(fieldStatuses[field].name, fieldStatuses[field].formValue)) ? fieldStatuses[field].errorMessage : fieldStatuses[field].successMessage;
	}

	// after we have set the error messages, determine if the form should be submitted
	if (!validateFarmName(form.farm_name.value) || !validateFarmDescription(form.farm_description.value) || !validateCoord(form.farm_latitude.value, "farm_lat_status") || !validateCoord(form.farm_longitude.value, "farm_lon_status")) {
		document.getElementById("formStatus").innerHTML = "Cannot submit form";
		return false;
	}

	// after we have replaced special characters, set this new value to the value in the form
	// description requires no validation other than requires at least one letter, and a limit of 140 characters a la twitter
	form.farm_description.value = alterFarmDescription(form.farm_description.value);
	return true;
}

// This function uses the correct validator given the field
function validationFunctionForField(field, val1) {
	switch(field) {
		case "farm_name_status":
			return validateFarmName(val1);
		case "farm_descr_status":
			return validateFarmDescription(val1);	
		case "farm_lat_status":
		case "farm_lon_status":
			return validateCoord(val1, field);
	}
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

// Check to see if the value the user entered is between negative and positive values
function validateCoord(farmCoord, farmCoordStatus) {
	if (farmCoord > Number.MAX_SAFE_INTEGER || farmCoord < ( -1  * Number.MAX_SAFE_INTEGER)) {
		return false;
	}
	return true;
}

// Show the user's position
function positionAction(position) {

	// Reset geo status
	document.getElementById("geoResults").innerHTML = "";

	// Need to hide loader
	document.getElementById("spinner").style = "display:none";

	// Grab user's location and return it
	document.getElementById("farm_latitude").value = position.coords.latitude; 
	document.getElementById("farm_longitude").value = position.coords.longitude;
}

