$(function () {

	$('form').on('submit', function (e) {

	  e.preventDefault();

	  $.ajax({
	    type: 'post',
	    url: '../dynamic/post_review.php',
	    data: $('form').serialize(),
	    success: function (data, textStatus, xhr) {
	      console.log(xhr.status);
	      $('form').replaceWith("<h1 class = \"specific-padding\">Thanks for submitting!</h1>");
	    },
	    fail: function (data, textStatus, xhr) {
	    	console.log(xhr.status);
	    	$('form').replaceWith("<h1 class = \"specific-padding\">Error in submitting.</h1>");
	    }
	  });
	});

});