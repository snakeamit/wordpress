	<?php
		if(!empty($errors)){
		echo "<p class='err' style='color:red; font-size: 22px; text-align:left;'>ERROR: ".nl2br($errors)."</p>";
		}
	?>
	<form method="POST" name="contact_form" action="">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="firstname"><b>NAME</b></label>
					<input id="name" type="text" name="name" value='<?php echo htmlentities($name) ?>' class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
					<label for="email"><b>EMAIL</b></label>
                    <input id="email" type="text" name="email" value='<?php echo htmlentities($visitor_email) ?>' class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="message"><b>MESSAGE</b></label>
                    <textarea id="message" name="message" rows=4 cols=30 class="form-control"><?php echo htmlentities($user_message) ?></textarea>
                </div>
            </div>
			<div class="col-md-12">
				<img src="contact-form/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br/>
				<label for='message'><b>Enter the code below:</b></label><br/>
				<input id="6_letters_code" name="6_letters_code" type="text"><br/>
				<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
			</div>
            <div class="col-md-12 text-center">
                <button type="submit" value="Submit" name="submit" class="btn btn-template-outlined"><i class="fa fa-envelope-o"></i> Send message</button>
            </div>
        </div>
    </form>
				
	<script language="JavaScript">
	// Code for validating the form
	// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
	// for details
	var frmvalidator  = new Validator("contact_form");
	//remove the following two lines if you like error message box popups
	//frmvalidator.EnableOnPageErrorDisplaySingleBox();
	//frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("name","req","Please provide your name"); 
	frmvalidator.addValidation("email","req","Please provide your email"); 
	frmvalidator.addValidation("email","email","Please enter a valid email address"); 
	</script>
	<script language='JavaScript' type='text/javascript'>
	function refreshCaptcha()
	{
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
	</script>
