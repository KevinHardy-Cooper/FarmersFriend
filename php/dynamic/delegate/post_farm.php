<!-- 
 - File: post_farm.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the logic flow to submit a new farm
 -->

<?php 
	# enable sessions to persist
	session_start();

	# error checking for submitted file
	if (!isset($_FILES['farm_image']['error']) || ($_FILES['farm_image']['error'] != UPLOAD_ERR_OK)) {
		echo '<h3> Error uploading file. </h3>';
		include '../invalid_submission.php';
		return;
	}

	# next, use PHP's file recognition library to check the type of the uploaded file
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	if ($finfo->file($_FILES['farm_image']['tmp_name']) === "image/jpeg") {
		$fileextension = "jpeg";
	} else if ($finfo->file($_FILES['farm_image']['tmp_name']) === "image/png") {
		$fileextension = "png";
	} else if ($finfo->file($_FILES['farm_image']['tmp_name']) === "image/jpg") {
		$fileextension = "jpg";
	} else {
		echo '<h3> Uploaded file was not a valid image. </h3>';
		include '../invalid_submission.php';
		return;
	}

	# create a filename by hashing the file using the SHA-1 cryptographic hash function
	$filehash = sha1_file($_FILES['farm_image']['tmp_name']);
	$filename = $filehash . "." . $fileextension;

	# get keys for S3 connection
	require('../../vendor/S3_connection.php');

	# include php library for S3
	require('../../vendor/S3.php');

	# creating an S3 connection using the keys
	$s3 = new S3($awsAccessKey, $awsSecretKey);

	# put the file into the S3 storage bucket
	$ok = $s3->putObjectFile($_FILES['farm_image']['tmp_name'], $bucketName, $filename, S3::ACL_PUBLIC_READ);

	# if valid file upload then do
	if ($ok) {

		# set url (image path) for newly uploaded file
		$url = 'https://s3.amazonaws.com/' . $bucketName . '/' . $filename;
	} else {

		# let user know that the file was not properly uploaded
		echo 'Error uploading file.';
	}

	# create a database connection
	include '../../query/database_connection.php';

	# query the database for if a a valid user exists given the session token
	include '../../query/select_user_based_on_session.php'; 

	# if a valid user is returned then proceed and validate the data submitted as a new farm
	if (isset($result[0]['userID'])) {
		include '../validator/validate_farm.php';
	} else {

		# if the user is using a fake token, then direct them to the sign in page
		header('Location: ../../static/sign_in.php?session=notLoggedIn');
	}
?>
