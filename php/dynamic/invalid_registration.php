				<!-- Headline for the page -->
				<h1 class = "specific-padding">
					Create an account.
				</h1>

				<!-- Form begins... -->
				<div class = "specific-padding large-text">
					
					<!-- TODO: Set action attribute to somewhere useful -->
					<form method = "post" onsubmit = "return validate(this)" action = "../dynamic/post_user.php">

						<!-- Full Name field -->
						<div class = "input-spacing required">
							<label>
								Full Name:
								<input class = "large-field" type = "text" placeholder = "Johnny Appleseed" name = "user_full_name" id = "user_full_name" maxlength = "40" value = <?php echo $name; ?> required>
							</label>
						</div>
						<div id = "user_full_name_status" class  = "errorStatus"></div>

						<!-- Birthday field -->
						<div class = "input-spacing required">
							<label>
								Date of Birth:
								<input class = "large-field" type = "date"  name = "user_birthday" id = "user_birthday" maxlength = "40" value = <?php echo $birthday; ?> required>
							</label>
						</div>
						<div id = "user_birthday_status" class  = "errorStatus"></div>

						<!-- Email Address field -->
						<div class = "input-spacing required">
							<label>
								Email Address:
								<input class = "large-field" type = "email" placeholder = "farmer@farm.com" name = "user_email_address" id = "user_email_address" maxlength = "40" value = <?php echo $email; ?> required>
							</label>
						</div>
						<div id = "user_email_address_status" class  = "errorStatus"></div>
						
						<!-- Enter Password field -->
						<div class = "input-spacing required">
							<label>
								Create a password:
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
								<input class = "large-field" type = "checkbox" name = "purpose" value = "to_write_reviews" > 
								To Write Reviews
							</label> 
							<br>

							<label>
								<input class = "large-field" type = "checkbox" name = "purpose" value = "to_register_farms"> 
								To Register Farm(s)
							</label>	 
							<br>

							<label>
								<input class = "large-field" type = "checkbox" name = "purpose" value = "to_browse_amazing_farms"> 
								To Browse Amazing Farms 
							</label>
							<br>
						</div>

						<!-- Are you a farmer field -->
						<!-- TODO: Increase the size of the radio buttons -->
						<div class = "input-spacing">
							Are you a farmer?
							<label>
								<input class = "large-field" type = "radio" name = "user_is_farmer" value = "true"> 
								Yes
							</label>
							<label>	
								<input class = "large-field" type = "radio" name = "user_is_farmer" value = "false"> 
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
