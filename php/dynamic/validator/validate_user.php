<!-- 
 - File: validate_user.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the server-side validator for the registration of a user
 -->

<?php
	
	# receiving form submission parameters via post method
	$name = $_POST['user_full_name'];
	$birthday = $_POST['user_birthday'];
	$email = $_POST['user_email_address'];
	$password = $_POST['user_password'];
	$re_entered_password = $_POST['re_entered_password'];
	$user_is_farmer = $_POST['user_is_farmer'];
	
	# this array will contain the multiple values that a series of checkboxes can submit
	$purpose_array = $_POST['purpose']; 

	# for the purpose of submitting the checkbox values into a database, we want to convert this array to a string, and this purpose string will contain all values for the checkboxes
	$purpose = "";

	# for each value that was checked off, append it to the purpose string
	foreach ($purpose_array as $p) {
		$purpose = $purpose . ", " . $p; 
	}

	# based on the previous logic, the string will start with ", ", we want to remove this
	$purpose = substr($purpose, 2, strlen($purpose)-1);

	# this array will contain the error messages to be displayed for the user
	$errors = array();

	# validate the given user name based on the given regex
	validatePattern($errors, $_POST, 'user_full_name', '/^[A-Z][a-z]+,?\s[A-Z][-\'a-zA-Z]{0,19}$/');

	# validate the user's birthday
	validateBirthday($errors, $birthday);

	# validate the given user's email address based on the given regex
	validatePattern($errors, $_POST, 'user_email_address', '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/');

	# validate the given user's password based on the given regex
	validatePattern($errors, $_POST, 'user_password', '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{7,}$/');
	
	# check if the given passwords are equal
	passwordsAreEqual($errors, $password, $re_entered_password);

	# after validating each field, if the error count is 0, do
	if (count($errors) == 0) {

		// data validates so continue with processing
		include '../../query/insert_user.php';
		include '../submitted.php';
	} else {

		# if some fields are not valid, then load page containing error display and previously submitted data
		include '../../../php/inc/head.inc';

		# echo head elements for the page
		echo '
			<!-- Page description -->
			<meta name = "description" content = "Create account to find and review farms">

			<!-- Importing external stylesheets -->
			<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
			<link href="/stylesheets/registration.css" type="text/css" rel="stylesheet"/>';

		# Including common navbar elements and set active page
		$active = 'sign_up'; include '../../inc/navbar.inc.php';
		
		# data doesn't validate so display error message
		echo "<h3>Please correct the following problems listed below:</h2>";

		# for each error message in the array of errors
		foreach ($errors as $error) {

			# display the field name where the error contains
			echo "<div class = 'errorStatus'>" . $error . "</div>";
		}

		# load the form populated with previously submitted data
		include '../invalid_registration.php';
	}

	# this method checks to see if the birthday that the user gave us was valid
	function validateBirthday(&$errors, $birthday) {

		# if birthday matches given regex, then do
		if (validatePattern($errors, $_POST, 'user_birthday', '/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/')) {
			
			# get the year as a variable from the string
			$year = substr($birthday, 0, 4);

			# currently, the olderst person alive was born in 1901, so if the user enters a birth year that is earlier than 1901, that's an error
			if ($year < 1901) {
				$errors['user_birthday'] = 'Invalid date of birth';
				return;
			}

			# get the month as a variable from the string
			$month = substr($birthday, 5, 6);

			# get the day as a variable from the string
			$day = substr($birthday, 8, 9);

			# an array of numbers representing the months in a year
			$valid_months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

			# based on the given day, we need to check if that day is valid given the month
			switch($day) {

				# if the day is the 29th, then all months are valid except for February when it isn't a leap year
				case 29:

					# check if the year is not a leap year
					if (!((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0))) {

						# February is eliminated if not a leap year
						$valid_months = array(1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
					}
					break;

				# if the day is the 30th, then February is definitely not valid
				case 30: 
					$valid_months = array(1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
					break;

				# only 7 of the 12 months have 31 days
				case 31: 
					$valid_months = array(1, 3, 5, 7, 8, 10, 12);
					break;

				# if not one of these values, then all months are valid
				default:
					break;
			}

			# if the given month does not exist in the array of valid months, then the month is not valid
			if(!in_array($month, $valid_months)) {
				$errors['user_birthday'] = 'Invalid date of birth';
				return;
			}

			# if the current time (in seconds) is less than the given birthdate (in seconds), then the user made their birthdate a future value which is invalid
			if (time() < strtotime($birthday)) {
				$errors['user_birthday'] = 'Invalid date of birth';
				return;
			}
		} else {

			# if birthday does not match given regex, then do
			$errors['user_birthday'] = 'Invalid date of birth';
		}
	}

	# this method sets the error message for the given field if it is not valid according to a given regex
	function validatePattern(&$errors, $field_list, $field_name, $pattern) {

		# if the user has not entered anything in the field in the form, set error message to reflect that the field is a required field
		if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
			setErrorMessage($errors, 'Required', $field_name);
			return false;
		} else if (!preg_match($pattern, $field_list[$field_name])) {
			
			# if user has entered a value for the field that does not follow the regex, set error message to invalid
			setErrorMessage($errors, 'Invalid', $field_name);
			return false;
		} else {

			# if no errors, then return true
			return true;
		}
	}

	# this method checks if the password and re-entered password are equal, and sets an error message if this is the case
	function passwordsAreEqual(&$errors, $password, $re_entered_password) {
		if ($password != $re_entered_password) {
			$errors['re_entered_password'] = 'Passwords do not match';
		}
	}

	# this method sets the error message for the error and gives the user better feedback on what field had the problem
	function setErrorMessage(&$errors, $error_message, $field_name) {
		switch($field_name) {
			case 'user_full_name': 
				$errors[$field_name] = $error_message . " name";
				break;
			case 'user_birthday':
				$errors[$field_name] = $error_message . " birthday";
				break;
			case 'user_email_address':
				$errors[$field_name] = $error_message . " email address";
				break;
			case 'user_password':
				$errors[$field_name] = $error_message . " password";
				break;
		}
	}
?>