<!-- 
 - File: invalid_registration.php
 - Author: Kevin Hardy-Cooper
 - Date: March 20, 2018
 - ABSTRACT: Contains the rest of registration page and pre-fills submitted answers
 -->
				<!-- Headline for the page -->
				<h1 class = "specific-padding">
					Create an account.
				</h1>

				<!-- Form begins... -->
				<div class = "specific-padding large-text">
					
					<!-- First validate form field values on the client side, then post form to server -->
					<form method = "post" onsubmit = "return validate(this)" action = "../dynamic/delegate/post_user.php">

						<!-- Full Name field -->
						<div class = "input-spacing required">
							<label>
								Full Name:

								<!-- fill field with $name variable from submission -->
								<input class = "large-field" type = "text" placeholder = "Johnny Appleseed" name = "user_full_name" id = "user_full_name" maxlength = "40" value = <?php echo $name; ?> required>
							</label>
						</div>
						<div id = "user_full_name_status" class  = "errorStatus"></div>

						<!-- Birthday field -->
						<div class = "input-spacing required">
							<label>
								Date of Birth:

								<!-- fill field with $birthday variable from submission -->
								<input class = "large-field" type = "date"  name = "user_birthday" id = "user_birthday" maxlength = "40" value = <?php echo $birthday; ?> required>
							</label>
						</div>
						<div id = "user_birthday_status" class  = "errorStatus"></div>

						<!-- Email Address field -->
						<div class = "input-spacing required">
							<label>
								Email Address:

								<!-- fill field with $email variable from submission -->
								<input class = "large-field" type = "email" placeholder = "farmer@farm.com" name = "user_email_address" id = "user_email_address" maxlength = "40" value = <?php echo $email; ?> required>
							</label>
						</div>
						<div id = "user_email_address_status" class  = "errorStatus"></div>
						
						<!-- Enter Password field -->
						<div class = "input-spacing required">
							<label>
								Create a password:

								<!-- made the security decision to not populate this field with the previously submitted password value -->
								<input class = "large-field" type = "password" name = "user_password" id = "user_password" placeholder = "***********" maxlength = "40" required>
							</label>
							
						</div>
						<div id = "user_password_status" class  = "errorStatus"></div>
						<p>
							Password must contain be at least 7 characters long, must contain at least one lowercase and uppercase letter, and at least one number.  No spaces or special characters allowed.
						</p> 

						<!-- Re-enter Password field -->
						<div class = "input-spacing required">
							<label>
								Re-enter password:

								<!-- made the security decision to not populate this field with the previously submitted password value -->
								<input class = "large-field" type = "password" id = "re_entered_password" name = "re_entered_password" placeholder = "***********" maxlength = "40" required>
							</label>
						</div>
						<div id = "re_entered_password_status" class  = "errorStatus"></div>

						<!-- Date of Birth field -->
						<div class = "input-spacing">
							<label>
								Why do you want to make a Farmer's Friend account? <br> Please check all that apply:
							</label>

							<br>

							<label>
								<input class = "large-field" type = "checkbox" name = "purpose" value = "to_write_reviews" 
								<?php 
									# if the purpose array contains the value for this checkbox, then check the box
									if (in_array("to_write_reviews", $purpose_array)) {
										echo "checked";
									} 
								?> 
								> 
								To Write Reviews
							</label> 
							<br>

							<label>
								<input class = "large-field" type = "checkbox" name = "purpose" value = "to_register_farms" 
								<?php 
									# if the purpose array contains the value for this checkbox, then check the box
									if (in_array("to_register_farms", $purpose_array)) {
										echo "checked";
									} 
								?> 
								> 
								To Register Farm(s)
							</label>	 
							<br>

							<label>
								<input class = "large-field" type = "checkbox" name = "purpose" value = "to_browse_amazing_farms"
								<?php 
									# if the purpose array contains the value for this checkbox, then check the box
									if (in_array("to_browse_amazing_farms", $purpose_array)) {
										echo "checked";
									} 
								?> 
								> 
								To Browse Amazing Farms 
							</label>
							<br>
						</div>

						<!-- Are you a farmer field -->
						<div class = "input-spacing">
							Are you a farmer?
							<label>
								<input class = "large-field" type = "radio" name = "user_is_farmer" value = "true"
								<?php 
									# if the purpose array contains the value for this checkbox, then check the box
									if ($isFarmer == true) {
										echo "checked";
									} 
								?>
								> 
								Yes
							</label>
							<label>	
								<input class = "large-field" type = "radio" name = "user_is_farmer" value = "false"
								<?php 
									# if the purpose array contains the value for this checkbox, then check the box
									if ($isFarmer == false) {
										echo "checked";
									} 
								?>
								> 
								No
							</label>
						</div>

						<!-- Submit button field -->
						<div class = "input-spacing">
							<input class = "large-field" type = "submit" value = "Create">
							<div id = "formStatus" class  = "errorStatus"></div>
						</div>
					</form>
				</div>
			</article>	

			<picture>
				<img class = "animal animal-right" alt = "Image of a cow" src = "/assets/img/vector-cow.png">
			</picture>
			
		</main>

		<!-- Including common footer element -->
		<?php include '../../php/inc/footer.inc'; ?>
		
		<!-- Importing external javascript here because the DOM must be loaded prior to importing -->
		<script src = "/js/registration.js"></script>
	</body>
</html>
