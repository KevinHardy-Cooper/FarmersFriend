// This function is the main client-side validation delegate 
function validate(form) {

	// This JSON contains the required fields and their respective messages
	var fieldStatuses = [
		{
			name: "user_full_name_status",
			formValue: form.user_full_name.value,
			emptyMessage: "No name entered",
			errorMessage: "Invalid full name",
			successMessage: ""
		},
		{
			name: "user_email_address_status",
			formValue: form.user_email_address.value,
			emptyMessage: "No email address entered",
			errorMessage: "Invalid email address",
			successMessage: ""	
		},
		{
			name: "user_password_status",
			formValue: form.user_password.value,
			emptyMessage: "No password entered",
			errorMessage: "Invalid password",
			successMessage: ""
		},
		{
			name: "re_entered_password_status",
			formValue: form.re_entered_password.value,
			emptyMessage: "Did not re-enter password",
			errorMessage: "Passwords are not equal",
			successMessage: ""	
		}
	];

	// check for empty required fields if HTML5 validation is not built into browser
	for (var field in fieldStatuses) {
		document.getElementById(fieldStatuses[field].name).innerHTML = (fieldStatuses[field].formValue == "") ? fieldStatuses[field].emptyMessage : fieldStatuses[field].successMessage;
	}

	// now we check for valid field values 
	for (var field in fieldStatuses) {

		// if the field is at the 0th index, we must set the second value to an empty string to avoid -1 being indexed
		if (field == 0) {

			//if the validator returns invalid, display appropriately
			document.getElementById(fieldStatuses[field].name).innerHTML = (!validationFunctionForField(fieldStatuses[field].name, fieldStatuses[field].formValue,  "")) ? fieldStatuses[field].errorMessage : fieldStatuses[field].successMessage;
		} else {
			document.getElementById(fieldStatuses[field].name).innerHTML = (!validationFunctionForField(fieldStatuses[field].name, fieldStatuses[field].formValue,  fieldStatuses[field-1].formValue)) ? fieldStatuses[field].errorMessage : fieldStatuses[field].successMessage;
		}
	}

	// after we have set the error messages, determine if the form should be submitted.  If any fields are invalid, do not submit form
	if (!validateFullName(form.user_full_name.value) || !validateEmailAddress(form.user_email_address.value) || !validatePassword(form.user_password.value) || !arePasswordsEqual(form.user_password.value, form.re_entered_password.value))  {
		document.getElementById("formStatus").innerHTML = "Cannot submit form";

		// do not submit form
		return false;
	}

	// submit form
	return true;
}

// This function uses the correct validator given the field
function validationFunctionForField(field, val1, val2) {
	switch(field) {
		case "user_full_name_status":
			return validateFullName(val1);
		case "user_email_address_status":
			return validateEmailAddress(val1);
		case "user_password_status":
			return validatePassword(val1);
		case "re_entered_password_status":
			return arePasswordsEqual(val1, val2);
	}
}

// This function validates the full name field
function validateFullName(fullName) {

	// check that full name is between 1 and 20 characters, also check for if it starts with a capital letter, if the second + characters are letters as well, then if there is a space, then a capital letter, and  if a hyphen or apostrophe appears it is still valid 
	var fullNamePattern = /^[A-Z][a-z]+,?\s[A-Z][-'a-zA-Z]{0,19}$/;
	return fullNamePattern.test(fullName);
}

// This function validates the email address field
function validateEmailAddress(emailAddress) {

	// using regex from slides to validate email address
	var emailAddressPattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/;
	return emailAddressPattern.test(emailAddress);
}

// This function validates the password field
function validatePassword(password) {

	// using regex from validate password
	// this regex statement checks for "Password must contain be at least 7 characters long, must contain at least one lowercase and uppercase letter, and at least one number. No spaces or special characters allowed."
	var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{7,}$/;
	return passwordPattern.test(password);
}

// verify that passwords are equal
function arePasswordsEqual(password1, password2) {
	if (password1 === password2) {
		return true;
	}
	return false;
}