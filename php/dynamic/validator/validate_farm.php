<!-- 
 - File: validate_farm.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the server side validator for the submission of a new farm
 -->

<?php

	# receiving form submission parameters via post method
	$name = $_POST['farm_name'];
	$description = $_POST['farm_description'];
	$latitude = $_POST['farm_latitude'];
	$longitude = $_POST['farm_longitude'];
	$imagePath = $file_name; # TODO: $_POST['farm_image'], once I get s3 set up this will contain the link for the s3 api;

	# this array will contain the error messages to be displayed for the user
	$errors = array();

	# validate the given farm name based on the given regex
	validatePattern($errors, $_POST, 'farm_name', '/^[A-Za-z][A-Za-z]+([ \'-][A-Za-z]+)*$/');

	# validate the given farm description  based on the given regex
	validatePattern($errors, $_POST, 'farm_description', '/^.{1,140}$/');

	# validate the given farm latitude
	validateCoord($errors, $_POST, 'farm_latitude');

	# validate the given farm longitude
	validateCoord($errors, $_POST, 'farm_longitude');

	# after validating each field, if the error count is 0, do
	if (count($errors) == 0) {

		// data validates so continue with processing
		include '../../query/insert_farm.php';
		include '../submitted.php';
	} else {

		# if some fields are not valid, then load page containing error display and previously submitted data

		# Including common head elements
		include '../../../php/inc/head.inc';

		# echo head elements for the page
		echo '
			<meta name = "description" content = "Post farm to be searched for and reviewed">

			<!-- Importing external stylesheets -->
			<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
			<link href="/stylesheets/submission.css" type="text/css" rel="stylesheet"/>';

		# Including common navbar elements and set active page
		$active = 'register'; include '../../inc/navbar.inc.php';

		# data doesn't validate so display error message
		echo "<h3>Please correct the following problems listed below:</h2>";

		# for each error message in the array of errors
		foreach ($errors as $error) {

			# display the field name where the error contains
			echo "<div class = 'errorStatus'>" . $error . "</div>";
		}

		# load the form populated with previously submitted data
		include '../invalid_submission.php';
	}

	# this method sets the error message for the given field if it is not valid according to a given regex
	function validatePattern(&$errors, $field_list, $field_name, $pattern) {

		# if the user has not entered anything in the field in the form, set error message to reflect that the field is a required field
		if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
			setErrorMessage($errors, 'Required', $field_name);
		} else if (!preg_match($pattern, $field_list[$field_name])) {

			# if user has entered a value for the field that does not follow the regex, set error message to invalid
			setErrorMessage($errors, 'Invalid', $field_name);
		}
	}

	# this method sets the error message for the given field 
	function validateCoord(&$errors, $field_list, $field_name) {

		# if the user has not entered anything in the field in the form, set error message to reflect that the field is a required field
		if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
			setErrorMessage($errors, 'Required', $field_name);
		} elseif ($field_list[$field_name] > PHP_INT_MAX || $field_list[$field_name] < ( -1 * PHP_INT_MAX)) {

			# if the user has entered invalid values for coordinates (in this case, greater or less than the maximium integer for the system)
			# set error message to reflect this
			setErrorMessage($errors, 'Invalid', $field_name);
		} elseif ($field_list[$field_name] > 180 || $field_list[$field_name] < -180) {

			# if the user has entered invalid values for coordinates (in this case, greater than 180 or less than -180) set error message to reflect this
			setErrorMessage($errors, 'Invalid', $field_name);
		}
	}

	# this method sets the error message for the error and gives the user better feedback on what field had the problem
	function setErrorMessage(&$errors, $error_message, $field_name) {
		switch($field_name) {
			case 'farm_name': 
				$errors[$field_name] = $error_message . " farm name";
				break;
			case 'farm_description':
				$errors[$field_name] = $error_message . " farm description";
				break;
			case 'farm_latitude':
				$errors[$field_name] = $error_message . " farm latitude";
				break;
			case 'farm_longitude':
				$errors[$field_name] = $error_message . " farm longitude";
				break;
		}
	}
?>