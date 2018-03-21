<!-- 
 - File: validate_user.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the server-side validator for the registration of a user
 -->

<?php


	$name = $_POST['user_full_name'];
	$birthday = $_POST['user_birthday'];
	$email = $_POST['user_email_address'];
	$password = $_POST['user_password'];
	$re_entered_password = $_POST['re_entered_password'];
	$purpose_array = $_POST['purpose'];
	$purpose = "";
	foreach ($purpose_array as $p) {
		$purpose = $purpose . ", " . $p; 
	}
	$purpose = substr($purpose, 2, strlen($purpose)-1);
	$user_is_farmer = $_POST['user_is_farmer'];

	$errors = array();
	validatePattern($errors, $_POST, 'user_full_name', '/^[A-Z][a-z]+,?\s[A-Z][-\'a-zA-Z]{0,19}$/');
	validateBirthday($errors, $birthday);
	validatePattern($errors, $_POST, 'user_email_address', '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/');
	validatePattern($errors, $_POST, 'user_password', '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{7,}$/');
	passwordsAreEqual($errors, $password, $re_entered_password);

	if (count($errors) == 0) {
		// data validates so continue with processing
		include '../../query/insert_user.php';
		include '../submitted.php';
	} else {

		include '../inc/head.inc' ;
		echo '
			<!-- Page description -->
			<meta name = "description" content = "Create account to find and review farms">

			<!-- Importing external stylesheets -->
			<link href="/stylesheets/global.css" type="text/css" rel="stylesheet"/>
			<link href="/stylesheets/registration.css" type="text/css" rel="stylesheet"/>';

		$active = 'sign_up'; include '../../inc/navbar.inc.php';
		// data doesn't validate so display error message
		echo "<h3>Please correct the following problems listed below:</h2>";
		foreach ($errors as $error) {
			echo "<div class = 'errorStatus'>" . $error . "</div>";
		}
		include '../invalid_registration.php';
	}

	function validateBirthday(&$errors, $birthday) {
		if (validatePattern($errors, $_POST, 'user_birthday', '/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/')) {
			$year = substr($birthday, 0, 4);
			if ($year < 1901) {
				$errors['user_birthday'] = 'Invalid date of birth';
				return;
			}
			$month = substr($birthday, 5, 6);
			$day = substr($birthday, 8, 9);

			$valid_months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

			switch($day) {

				case 29:
					if (!((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0))) {
						$valid_months = array(1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
					}
					break;
				case 30: 
					$valid_months = array(1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
					break;
				case 31: 
					$valid_months = array(1, 3, 5, 7, 8, 10, 12);
					break;
				default:
					break;
			}

			if(!in_array($month, $valid_months)) {
				$errors['user_birthday'] = 'Invalid date of birth';
				return;
			}

			if (time() < strtotime($birthday)) {
				$errors['user_birthday'] = 'Invalid date of birth';
				return;
			}

		} else {
			$errors['user_birthday'] = 'Invalid date of birth';
		}
	}

	function validatePattern(&$errors, $field_list, $field_name, $pattern) {
		if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
			setErrorMessage($errors, 'Required', $field_name);
			return false;
		} else if (!preg_match($pattern, $field_list[$field_name])) {
			setErrorMessage($errors, 'Invalid', $field_name);
			return false;
		} else {
			return true;
		}
	}

	function passwordsAreEqual(&$errors, $password, $re_entered_password) {
		if ($password != $re_entered_password) {
			$errors['re_entered_password'] = 'Passwords do not match';
		}
	}

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