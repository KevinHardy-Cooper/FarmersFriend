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
			name: "user_birthday_status",
			formValue: form.user_birthday.value,
			emptyMessage: "No date of birth entered",
			errorMessage: "Invalid date of birth",
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
	if (!validateFullName(form.user_full_name.value) || !validateBirthday(form.user_birthday.value) || !validateEmailAddress(form.user_email_address.value) || !validatePassword(form.user_password.value) || !arePasswordsEqual(form.user_password.value, form.re_entered_password.value))  {
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
		case "user_birthday_status":
			return validateBirthday(val1);	
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

// This function validates the birthday field
function validateBirthday(birthday) {

	// validates if birthday is in the correct format using the regular expression below, where correct format is yyyy-mm-dd
	// the regex checks the formatting and then validates the following:
	// the string starts with 4 digits
	// then checks if the 4 digits are followed by a hyphen
	// the next section enclosed in () is used to make sure that the month number is between 1 and 12, with the option of a leading zero if single digits
	// then checks if the previous section is followed by a hyphen
	// the last section enclosed in () is used to make sure that the day number is between 1 and 31, with the option of a leading zero if single digits
	// the previous section must end with those one/two numbers for the day
	// inspired by https://stackoverflow.com/questions/22061723/regex-date-validation-for-yyyy-mm-dd
	var birthdayPattern = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;

	// if the regex is valid so far, now we need to check if the dates are realistic
	if(birthdayPattern.test(birthday)) {

		// according to wikipedia, the oldest living person was born on August 4, 1900, and assuming that she will not use this website, all birthday years must be >1900.
		var year = parseInt(birthday.substring(0, 4));
		if (year < 1901) {
			return false;
		}

		// grab month out of birthday string, and take out hyphen if user entered single digit
		var month = birthday.substring(6, 8);
		month = parseInt(month.replace("-", ""));

		// grab day out of birthday string, and take out hyphen if user entered single digit
		var day = birthday.substring(birthday.length-2,birthday.length);
		day = parseInt(day.replace("-", ""));

		// now we need to check if the number of days given can exist in the given month
		var validMonths = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

		switch(day) {

			// february is the reason for this edge case
			case 29:
				// check for leap year
				if (!(((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0))) {
					validMonths = [1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
				}
				break;
			case 30:
				validMonths = [1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
				break;
			case 31:
				validMonths = [1, 3, 5, 7, 8, 10, 12];
				break;
			default:
				break;
		}
		
		// if the given month is included in the array of valid months, that's good
		if(!validMonths.includes(month)){
			return false;
		}

		// now the last thing to check for is if the given birthday is in the future

		// get todays date and put it into the format we want
		var today = new Date();
		var todaysDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

		// create a date object using the birthday the user entered
		var birthDate = new Date(birthday);

		// if the data of birth is in the future, return false
		if (birthDate > todaysDate) {
			return false;
		}
	} else {
		return false;
	}
	return true;
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