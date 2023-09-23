<?php
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];    
    $allow = $_SESSION['userallow']; 
  }else{
    $user="";
    $allow="";
  }

  if($user==""){
    //header("Location: login.php"); 
    //exit();
  }else{
    
  }
?>

<?php
$_SESSION['discount']= (float)0;

if(isset($_POST['submitCode'])){
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";

  //Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $ccode = $_POST['ccode'];
  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
  $dateNow = $date->format('Y-m-d');

  $sqlc = "SELECT * FROM `couponFxpress` WHERE `code`='$ccode' AND `end` >= '$dateNow' ";
  $resultc = $conn->query($sqlc);

  $_SESSION['discount'] = (float)0;
  
  if ($resultc->num_rows > 0) {
    while($rowc = $resultc->fetch_assoc()) {  
      $_SESSION['discount'] = (float) $rowc['discount'];
    }
  }else{
    $_SESSION['discount'] = (float)0;
  }

  $conn->close();
}

$your_email = 'no-reply@ibrlive.com';

$errors = '';
$usename = '';
$subject = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submitQuery']))
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
                		"<tr><td><strong>Subject:</strong> 'Need FXPRESS free trial!'</td></tr>\n".
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

// include database configuration file
include 'dbConfig.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Our Products | IBR Live</title>
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
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 <style>
    
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    
    hr.divider {
		max-width: 3.25rem;
		border-width: 0.2rem;
		border-color: #f4623a;
	}
  </style>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: white;">
      
    <div class="modal fade" id="validateCoupon">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Discount Coupon</h4>
          </div>
          <form action="" class="form-horizontal" role="form" method="post">
	      <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <label for="ccode" class="col-sm-6 control-label">Coupon Code</label>

                <div class="col-sm-6">
				  <input required class="form-control" id="ccode" name="ccode" type="text" maxlength="6" placeholder="Coupon Code" />
                </div>
			  </div>

            </div>
            <!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		    <button type="submit" name="submitCode" id="submitCode" value="Apply Code" class="btn-upper btn btn-primary">Apply Coupon</button>
          </div>
	      </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="contactFxpress">
      <div class="modal-dialog modal-sm-6">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><strong>Contact us for FXPRESS free trial!</strong></h4>
          </div>
          <form role="form" method="POST" class="form-horizontal" action="">
          <div class="modal-body">
            <div class="box-body">
                      
            <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-9">
			    <input readonly type="text" class="form-control" maxlength="20" name="name" id="name" value="<?php echo $_SESSION['username'];?>">
              </div>
			</div>  
			
			<div class="form-group">
			  <label for="email" class="col-sm-3 control-label">Email address</label>
			  <div class="col-sm-9">
                <input readonly type="email" class="form-control" maxlength="50" name="email" id="email" value=<?php echo $_SESSION['useremail'];?>>    
              </div>
			</div> 
			
			<div class="form-group">
			  <label for="email" class="col-sm-3 control-label">Phone</label>
			  <div class="col-sm-9">
                <input type="text" class="form-control" maxlength="15" name="phone" id="phone" onKeyPress="return isNumberKey(event);" 
 value="<?php echo $_SESSION['userphone']; ?>">    
              </div>
			</div>    
              
            <div class="form-group">
              <label for="subject" class="col-sm-3 control-label">Subject</label>
              <div class="col-sm-9">
                <input readonly type="subject" class="form-control" maxlength="100" name="subject" id="subject" value="Need FXPRESS free trial!">    
              </div>    
            </div>    

            <div class="form-group">
              <label for="message" class="col-sm-3 control-label">Additional Query?</label>
              <div class="col-sm-9">
                <textarea class="form-control" id="message" name="message" placeholder="Enter your query (max 250 chars)" maxlength="250" rows="3" style="resize: none;"></textarea>
              </div>
            </div>  
            
            <div class="form-group">
              <label for="captchaCode" class="col-sm-3 control-label">Write this code below</label>
              <div class="col-sm-9">
                <img src="captcha.php" />
              </div>
            </div>
            
            <div class="form-group">
              <label for="captcha" class="col-sm-3 control-label"></label>
              <div class="col-sm-9">
                <input required type="text" class="form-control" maxlength="8" name="captcha" id="captcha">    
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		      <button type="submit" name="submitQuery" id="submitQuery" value="Submit" class="btn-upper btn btn-primary">Submit</button>
            </div>
            </div>  
          </div>    
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Main content -->
    <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="">
                <div class="box-header" align=center>
                  <i class="fa fa-file-text"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Our Products</b> </p>
                  <hr class="divider">
                </div>

              </div>
            </div><!-- /.col -->

            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="">
                <div class="box-header">
                <!-- <a href="viewCart.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i> View Cart</a> -->
                
                <a class="btn btn-warning" href="viewCart.php" style="float: right;" title="View Cart"><i class="fa fa-shopping-cart"></i> View Cart</a> 
                </div><!-- /.box-header -->
                <div class="box-body">

  <div class="row list-group">
        <?php
        //get rows query
        $query = $db->query("SELECT * FROM products WHERE id='7' ");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
        
           
        <div class="item col-lg-12">
            <div class="thumbnail" style="padding: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="caption">
                    <h4 class="list-group-item-heading text-primary" style="font-weight: bold;"><?php echo $row["name"]; ?> </h4>
                    <p class=""><?php echo $row["description"]; ?></p>
                    <hr>
                    <p class="list-group-item-text text-primary"><?php echo $row["duration"].' days'; ?></p>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="lead text-success" style="font-weight: bold;"><?php echo '&#8377; '.(float)($row["price"]- ($row["price"]*$_SESSION['discount'])/100); ?> /- only</p>
                        </div>
                        <div class="col-md-8">
                            <a class="btn btn-primary" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#validateCoupon"><i class="fa fa-tag"></i> Discount Coupon?</a>
                        </div>
                        <!--
                        <div class="col-md-12 text-right" style="margin-top: 8px;">
                         <a style="cursor: pointer; color: orange; border: 1px solid orange; padding: 5px;" data-toggle="modal" data-target="#contactFxpress"><i class="fa fa-envelope"></i> Contact us for 10 days Free Trial</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!--div class="item col-lg-6">
            <div class="thumbnail" style="padding: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="caption">
                    <h4 class="list-group-item-heading text-primary" style="font-weight: bold;">Mock Test Series </h4>
                    <p class="">01 Certificate Course in Foreign Exchange</p>
                    <p class="">02 Mutual Fund Distributors Certificate Examination - Series V-A</p>
                    <p class="">03 Certificate Examination for Debt Recovery Agents & DRA Tele-Callers</p>
                    <p class="">04 Certificate Examination for Business Correspondents / Facilitators</p>
                    <p class="">05 Aadhar Supervisor / Operator & Child Enrolment Lite Client Operator</p>
                    <hr/>
                    <a href="https://ibrlive.estudium.org/">Click here to visit our new website (ibrlive.estudium.org) to access the mock test series!</a><br/>
                    <button style="margin-top: 10px;" class="btn btn-primary text-white"><a style="color: white;" href="https://ibrlive.estudium.org/">IBRLive.estudium.org</a></button>
                </div>
            </div>
        </div--> 
        
        <div class="item col-lg-3">
        </div>
        <?php } }else{ ?>
        
        <?php } ?>
    </div>
    
    <div id="products" class="row list-group">
        <?php
        //get rows query
        $query = $db->query("SELECT * FROM products WHERE id=='9' ORDER BY id ASC LIMIT 10");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
        <div class="item col-lg-4" style="margin-bottom: 20px;">
            <div class="thumbnail" style="padding: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="caption">
                    <h4 class="list-group-item-heading text-primary" style="font-weight: bold;"><?php echo $row["name"]; ?></h4>
                    <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                    <hr>
                    <p class="list-group-item-text text-primary"><?php echo $row["duration"].' days'; ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead text-success" style="font-weight: bold;"><?php echo '&#8377; '.(float)$row["price"]; ?> /- only</p>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <!-- <p>Product(s) not found.....</p> -->
        <?php } ?>
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
