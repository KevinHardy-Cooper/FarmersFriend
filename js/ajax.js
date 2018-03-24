/**
 * File: ajax.js
 * Author: Kevin Hardy-Cooper
 * Date: March 20, 2018
 * ABSTRACT: This file will asynchoronously post a review using AJAX
 */
$(function () {

	// if the form is submitted
	$('form').on('submit', function (e) {

		// don't allow the form to be submitted using another method
		e.preventDefault();

		// let the ajax begin
		// sending a JSON containing form submission type, where to handle the form submission, the form data itself, and then what to do upon success or failure
		$.ajax({
			type: 'post',
			url: '../../dynamic/delegate/post_review.php',
			data: $('form').serialize(),
			success: function (data, textStatus, xhr) {

				// on success, we want to replace the form div with feedback to the user that the submission was a success
		  		$('form').replaceWith("<h1 class = \"specific-padding\">Thanks for submitting!</h1>");
			},
			fail: function (data, textStatus, xhr) {

				// on failure, we want to replace the form div with feedback to the user that the submission was a failure
				$('form').replaceWith("<h1 class = \"specific-padding\">Error in submitting.</h1>");
			}
	  	});
	});
});