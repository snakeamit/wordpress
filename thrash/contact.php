<!DOCTYPE html>
<?php 
$your_email = 'no-reply@ibrlive.com';
session_start();
$errors = '';
$usename = '';
$subject = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	$usename = $_POST['name'];
	$visitor_email = $_POST['email'];
	$visitor_phone = $_POST['phone'];
	$user_message = $_POST['message'];
	///------------Do Validations-------------


	if($_POST['captcha'] == $_SESSION['code']){
		//$errors .= "correct captcha";
	}else{
		$errors .= "Invalid captcha";
	}
	
	if(empty($visitor_email))
	{
		$errors .= "Email is required fields.\n";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "Bad email value!\n";
	}
	if(empty($usename))
	{
		$errors .= "Name is required fields.\n";	
	}	
	if(empty($errors))
	{
		//send the email
		$to = "contact@ibrlive.com";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "<html><body><table><tr style='background: #eee;'><td><strong>$usename</strong> wants you to contact him/her.</td>\n".
				"<tr><td><strong>Name:</strong> $usename</td></tr>\n".
                		"<tr><td><strong>Subject:</strong> 'Answer My Query'</td></tr>\n".
                                "<tr><td><strong>Phone:</strong> "." $visitor_phone</td></tr>\n".
				"<tr><td><strong>User Email:</strong> ".
				"$visitor_email</td>
				<td><strong>Message:</strong> ".
				"$user_message</td></tr></table></body></html>\n\n";//.
				"IP: $ip\n";	
				$headers = array("From: $from",
					"Reply-To: $visitor_email",
					"MIME-Version: 1.0",
					"Content-type:text/html;charset=UTF-8",
					"X-Mailer: PHP/" . PHP_VERSION
				);
		$headers = implode("\r\n", $headers);
		
		if(mail($to, 'contact form', $body,$headers)){  
		  header('location: thank-you.php');
		  exit;
		}
		else{
		  header('location: regret.php');
		  exit;
		}
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>

<!-- a helper script for vaidating the form-->
<script language="JavaScript" src="contact-form/script/gen_validatorv31.js" type="text/javascript"></script>	

<div id='contact_form_errorloc' style="text-align:center; color:red;" class='err'></div>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Contact Us | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
    function isNumberKey(evt)
    	{
      		var charCode = (evt.which) ? evt.which : event.keyCode
      		if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
        		return false;
      		return true;
    	} 
  </script>

  <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 418px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
       
  </style>

</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-envelope"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Contact Us </p>
                </div>

              </div>
            </div><!-- /.col -->

            <div class="col-md-4">
              <!-- general form elements disabled -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><b>Contact Us</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group" align=center>
                      <p style="font-size: 38px;">LEARN AND SPREAD</p>
                      <p style="font-size: 16px;">Uttam Market</p>
                      <p style="font-size: 16px;">Near Mohan Nagar Post office</p>
                      <p style="font-size: 16px;">Kurukshetra, Haryana</p>
                      <p style="font-size: 16px;">INDIA</p>
                      <p style="font-size: 16px;">Pin code: 136118</p>
                      <p style="font-size: 18px;">PHONE: <font style="color: blue;">+91-9991679244</font> , <font style="color: blue;">+91-9991622344</font></p>
                      <p style="font-size: 18px;">EMAIL: <font style="color: blue;">contact@ibrlive.com</font></p><br/><br/><br/><hr/>
                      <img src="pix.jpg" style="width: 60%;"/>
                    </div>
                  </form>         
                 </div>
               </div>
             </div>
  
              <!-- right column -->
             <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><b>Contact Form</b></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
		if(!empty($errors)){
		  echo "<p class='err' style='text-align: center; color:red; font-size: 14px;'>ERROR: ".nl2br($errors)."</p>";
		}
	        ?>
                <form role="form" method="POST" name="contact_form" action="">
                  
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input required type="text" class="form-control" maxlength="20" name="name" id="name" placeholder="Enter full name">
                    </div>

                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input required type="email" class="form-control" maxlength="50" name="email" id="email" placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Phone</label>
                      <input type="text" class="form-control" maxlength="15" name="phone" id="phone" onKeyPress="return isNumberKey(event);" 
 placeholder="Enter your phone">
                    </div>

                    <div class="form-group">
                      <label for="message">Your Query</label>
                      <textarea required class="form-control" id="message" name="message" placeholder="Enter your query (max 250 chars)" maxlength="250" rows="3" style="resize: none;"></textarea>
                    </div>
                    
                    <div class="form-group">
                    <img src="captcha.php" />
                    <br/>
                    Write the code below:
                    <br/>
                    <input type="text" name="captcha" />
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer" align=center>
                    <button value="Submit" name="submit"  type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>

                <script language="JavaScript">
	          var frmvalidator  = new Validator("contact_form");
	          frmvalidator.addValidation("name","req","Please provide your name"); 
                  frmvalidator.addValidation("email","req","Please provide your email"); 
	          frmvalidator.addValidation("email","email","Please enter a valid email address"); 
	        </script>
              </div><!-- /.box -->
            </div>
            
             <div class="col-md-4">
              <!-- general form elements disabled -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><b>Reach Us</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group" align=center>                      
                      <div id="map"></div>
<script>
// Initialize and add the map
function initMap() {

    // position we will use later
    var lat = 29.972157;
    var lon = 76.855166;
    // initialize map
    map = L.map('map').setView([lat, lon], 13);
    // set map tiles source
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
      maxZoom: 18,
    }).addTo(map);
    // add marker to the map
    marker = L.marker([lat, lon]).addTo(map);
    // add popup to the marker
    marker.bindPopup("<b>Learn & Spread.</b><br /> Kurukshetra (Haryana) <br /> India").openPopup();

}
    </script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3Ja4dJOkPL-SVyO77gyJ2jh-kkuBZXiU&callback=initMap">
    </script>
                    </div>
                  </form>         
                 </div>
               </div>
             </div>


            
          </div><!-- ./row -->
    </section>
  </div>  

    
  <?php include_once("include/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>