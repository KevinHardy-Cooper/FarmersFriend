<?php

	$name = $_POST['farm_name'];
	$description = $_POST['farm_description'];
	$latitude = $_POST['farm_latitude'];
	$longitude = $_POST['farm_longitude'];
	$imagePath = ""; #$_POST['farm_image'];

	$errors = array();
	validatePattern($errors, $_POST, 'farm_name', '/^[A-Za-z][A-Za-z]+([ \'-][A-Za-z]+)*$/');
	validatePattern($errors, $_POST, 'farm_description', '/^.{1,140}$/');
	validateCoord($errors, $_POST, 'farm_latitude');
	validateCoord($errors, $_POST, 'farm_longitude');

	if (count($errors) == 0) {
		// data validates so continue with processing
		include '../../query/insert_farm.php';
		include '../submitted.php';
	} else {

		include '../../../php/inc/head.inc';

		echo '<meta name = "description" content = "Post farm to be searched for and reviewed">

		<!-- Importing external stylesheets -->
		<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
		<link href="/stylesheets/submission.css" type="text/css" rel="stylesheet"/>';

		$active = 'register'; include '../../inc/navbar.inc.php';

		// data doesn't validate so display error message
		echo "<h3>Please correct the following problems listed below:</h2>";
		foreach ($errors as $error) {
			echo "<div class = 'errorStatus'>" . $error . "</div>";
		}
		include '../invalid_submission.php';
		
	}

	function validatePattern(&$errors, $field_list, $field_name, $pattern) {
		if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
			setErrorMessage($errors, 'Required', $field_name);
		} else if (!preg_match($pattern, $field_list[$field_name])) {
			setErrorMessage($errors, 'Invalid', $field_name);
		}
	}

	function validateCoord(&$errors, $field_list, $field_name) {
		if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
			setErrorMessage($errors, 'Required', $field_name);
		} elseif ($field_list[$field_name] > PHP_INT_MAX || $field_list[$field_name] < ( -1 * PHP_INT_MAX)) {
			setErrorMessage($errors, 'Invalid', $field_name);
		} elseif ($field_list[$field_name] > 180 || $field_list[$field_name] < -180) {
			setErrorMessage($errors, 'Invalid', $field_name);
		}
	}

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