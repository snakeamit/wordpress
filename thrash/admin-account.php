<?php
  $successProf="";
  $errorProf="";
  $successFeed="";
  $errorFeed="";
  
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
    header("Location: login.php"); 
    exit();
  }else{
    if($allow==""){
      
    }else{
      
    }
  }
  
  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] != "7"){
        header("Location: profile.php"); 
        exit();
    }
  }
?>

<?php
if(isset($_SESSION['useremail'])){
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

  $error = ""; $success = "";

  $hash = "";
  $allow = "";

  $name = "";
  $paid = "";
  $created = "";
  $validity = ""; 
  $amount = "";
  $member = "";
  $phone = "";
 
  $email = $_SESSION['useremail'];
  
  if($error == ""){
    $sql = "SELECT id, name, member, phone, paid, created, validity, amount, password FROM customers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $hash = $row['password'];  
        $_SESSION['userallow'] = $row['paid'];
        $_SESSION['username'] = $row['name'];    
        $name = $row['name'];
        $paid = $row['paid'];
        $created = $row['created'];
        $validity = $row['validity'];
        $amount = $row['amount'];
        //$member = $row['member'];
        $phone = $row['phone'];    	
      }
    }else{
      $error = "Invalid Email or Password";
    } 
    //$conn->close();   
  }

  if($hash==""){
      $error = "Invalid Email or Password";
  }else{
    if (!empty($_POST["passworduser"])) {  
        $auth = password_verify($_POST['passworduser'], $hash);
        if($auth == 1){
            $allow;
            $success = "Authentication successful";
            header('Location: welcome.php');
            exit();
        }else{
            $error = "Invalid Email or Password";
        }
    }
  }

  if(!isset($_SESSION['member'])){
    $custId = $_SESSION['sessCustomerID'];
    
    $sql2 = "SELECT product_id FROM `subscription` WHERE `status`='AVAILABLE' AND `customer_id`='$custId' ORDER BY product_id DESC";

    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
      
      $maxid=0;
      while($row2 = $result2->fetch_assoc()) {
        if($row2['product_id']=="6" || $row2['product_id']=="3"){
          $maxid=6;
        }

        if($row2['product_id']=="5" || $row2['product_id']=="2"){
          if($maxid>=6){ 
          }else{
            $maxid=5;
          }
        }

        if($row2['product_id']=="4" || $row2['product_id']=="1"){
          if($maxid>=5){ 
          }else{
            $maxid=4;
          }
        }         
      }

      switch($maxid){
        case "1":
          $member ="Standard";
          break;

        case "2":
          $member ="Gold";
          break;

        case "3":
          $member ="Platinum";
          break;

        case "4":
          $member ="Standard";
          break;

        case "5":
          $member ="Gold";
          break;

        case "6":
          $member ="Platinum";
          break;

        default:
          $member ="Normal";
      }

      $_SESSION['member']=$member;   
    }else{
      $member="Normal";
      $_SESSION['member']="Normal";
    }    
  }else{
    $member=$_SESSION['member'];
  }

  $conn->close();
}

  include("dashboard/updateProf.php");
  #include("dashboard/updateProfPass.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Profile | IBR Live</title>
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
    .shiftr15 {
      margin-right: 15px;
    }

    .shiftt30 {
      margin-top: 30px;
    }

    .shiftb30 {
      margin-bottom: 30px;
    }

    .shiftt50 {
      margin-top: 50px;
    }

    .shiftb50 {
      margin-bottom: 50px;
    }

    .shiftt100 {
      margin-top: 100px;
    }

    .shiftb100 {
      margin-bottom: 100px;
    }

    .shiftt80 {
      margin-top: 80px;
    }

    .shiftb80 {
      margin-bottom: 80px;
    }

    .userWelcome{
      padding: 10px; 
      background: #CD5C5C;
      color: white;
    }

    .leftNavDefault{
      display: none;
    }

    .img-thumbnail {
      max-width: 50%;
      height: auto;
    }
    
    .panelBorderColor {
      border-color: #ddd;
    }
  </style>
  
  <script>
  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  } 
  </script>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
  <?php include_once('include/top-menu.php'); ?>
  
  <main role="main" class="shiftt50" >
  <div class="container-fluid shiftb80">
	<!-- Left Column -->
	<div class="col-sm-2">

	  <!-- List-Group Panel -->
	  <div class="panel panel-primary panelBorderColor">
		<div class="panel-heading">
		  <h1 class="panel-title"><span class="glyphicon glyphicon-random"></span> Manage Account</h1> 
		</div>
                <br>     
		<div class="list-group" id="leftnav">					
		  <a id="t-1" onclick="onNavClick('1')" href="#" id="1" class="list-group-item"><i class="fa fa-user"></i> <strong> Profile</strong></a>
		  <a id="t-2" onclick="onNavClick('2')" href="#" id="2" class="list-group-item active"><i class="fa fa-credit-card"></i> <strong> Your Subscriptions</strong></a>
		  <a id="t-3" onclick="onNavClick('3')" href="#" id="3" class="list-group-item"><i class="fa fa-home"></i> <strong> Dashboard</strong></a>
		</div>
	  </div>			
	</div><!--/Left Column-->

    <div id="d-1" class="leftNavDefault shiftb80">
    <!-- Middle Column Profile -->
	<div class="col-sm-4">
	  <!-- List-Group Panel -->
	  <div class="panel panel-primary panelBorderColor">
	    <div class="panel-heading">
	      <h1 class="panel-title"><span class="glyphicon glyphicon-user"></span> User Profile</h1>			
    	    </div>
		 
		<div class="list-group">
		  <div class="row">
			<div class="col-sm-12">

			<p class="list-group-item"> <strong>Name: </strong><?php echo $_SESSION["username"]; ?></p>
			<p class="list-group-item"> <strong>Email:</strong> <?php echo $_SESSION["useremail"]; ?></p>
			<p class="list-group-item"> <strong>Phone no:</strong> <?php echo $_SESSION["userphone"]; ?></p>
			
			<p class="list-group-item"> <strong>Member Since:</strong> <?php echo date("d-m-Y", strtotime($created)); ?></p>

			</div>
		  </div>	
		</div>
	  </div>
	</div><!--/Middle Column Profile -->
	  
	<!-- Right Column Profile -->
	<div class="col-sm-6">
	  <!-- List-Group Panel -->
		<div class="panel panel-primary panelBorderColor">
		  <div class="panel-heading">
			<h1 class="panel-title"><span class="glyphicon glyphicon-user"></span> Manage User Profile</h1>
		  </div>
		  <div class="panel-body">
		  <!-- Alert -->
		  <?php
          	  if($successProf != ""){
	          ?>
          	    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <strong>Success:</strong> <?php echo $successProf; $successProf=""?>
          	    </div>
         	  <?php
          	  } else if($errorProf != "") {
          	  ?>
          	    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error:</strong> <?php echo $errorProf; $errorProf="" ?>
          	  </div>
          	  <?php
          	  }
          	  ?>
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h1 class="panel-title"><span class="glyphicon glyphicon-plus"></span><strong> Modify Profile Information </strong></h1>
			  </div>
			  <div class="panel-body">					
				<form action="" method="POST">						
				  <div class="form-group">
				  <label for="uname">Full Name &#42;</label>
				  <input required maxlength="25" type="text" class="form-control" id="uname" name="uname" placeholder="Full Name" value="<?php echo $_SESSION['username'];?>">
				  </div>
				  <div class="form-group">
				  <label for="uemail">Email &#42;</label>      
				  <input required readonly maxlength="50" type="email" class="form-control" id="uemail" name="uemail" placeholder="Email" value="<?php echo $_SESSION['useremail']; ?>">
				  </div>
				  <div class="form-group">
				  <label for="uphone">Phone &#42;</label>      
				  <input required maxlength="15" minlength="10" onKeyPress="return isNumberKey(event);" type="text" class="form-control" id="uphone" name="uphone" placeholder="Phone No." value="<?php echo $_SESSION['userphone'];?>">
				  </div>

				  <button type="submit" name="updateProf" class="btn btn-warning">Update</button>
				</form>
			  </div>
			</div>   
		  </div>
          <!--
          <div class="panel-body">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h1 class="panel-title"><span class="glyphicon glyphicon-plus"></span><strong> Change Password </strong></h1>
			  </div>
			  <div class="panel-body">			
				<form action="" method="POST">						
				  <div class="form-group">
					<label for="pwd">New Password &#42;</label>
					<input required maxlength="15" minlength="8" autocomplete="off" type="password" class="form-control" id="pwd" name="pwd" placeholder="Min 8 and Max 15 Chars long">
				  </div>
				  <div class="form-group">
					<label for="repwd">Retype New Password &#42;</label>
					<input required maxlength="15" minlength="8" autocomplete="off" type="password" class="form-control" id="repwd" name="repwd" placeholder="Re-Type Password">
				  </div>
				  <button type="submit" name="updateProfPass" class="btn btn-warning">Update</button>
				</form>
			  </div>
			</div>
		  </div>
		  -->
		</div>
    </div><!--/Right Column Profile-->
   </div>

	<!-- Right Column Subscription -->
	<div class="col-sm-10 shiftb80" id="d-2">
	  <!-- List-Group Panel -->
	  <div class="panel panel-primary panelBorderColor">
		<div class="panel-heading">
		  <h1 class="panel-title"><span class="glyphicon glyphicon-credit-card"></span> Your Subscriptions</h1>
		</div>
		<div class="list-group">

		    <div class="box-body table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>Order No</th>
                  <th>Product</th>
                  <th>Paid On</th>
                  <th>Valid Until</th>  
                  <th>Status</th>                  
                </tr>

                <?php
                //Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }   
    
                $custId= $_SESSION['sessCustomerID'];
                $query = "SELECT * FROM subscription WHERE customer_id='$custId'"; 
                $result2 = $conn->query($query);
	
                $pname = "";
                while($row2 = $result2->fetch_assoc()){  
                  switch($row2['product_id']){
                    case "1":
                      $pname="MF-Standard";
                      break;

                    case "2":
                      $pname="MF-Gold";
                      break;

                    case "3":
                      $pname="MF-Platinum";
                      break;

                    case "4":
                      $pname="FE-Standard";
                      break;

                    case "5":
                      $pname="FE-Gold";
                      break;

                    case "6":
                      $pname="FE-Platinum";
                      break;

                    default:
                      $pname="";
                  }   
                  
                  if($pname!="" && $row2['status']!="NOTAVAILABLE")
                    echo "<tr><td>" . $row2['order_id'] . "</td><td>" . $pname . "</td><td>" . date("d-m-Y", strtotime($row2['paid_on'])) . "</td><td>" . date("d-m-Y", strtotime($row2['expire_on'])) . "</td><td>" . $row2['status'] . "</td></tr>"; 
                }

                ?>
              </table>
            </div>
            <!-- /.box-body -->

	  </div>
	  </div>

	</div><!--/Right Column Subscription -->

	<!-- Right Column Dashboard -->
    <div class="col-sm-10 shiftb80 leftNavDefault" id="d-3">
	  <div class="panel panel-primary panelBorderColor">
        <div class="panel-heading">
          <h1 class="panel-title"><span class="glyphicon glyphicon-edit"></span> Manage IBRLive</h1>
        </div>
			
        <div class="panel-body">
          <div class="list-group">
            <div class="row">
              <div class="col-sm-12">
                <a href="https://ibrlive.com/feedback/track" style="text-decoration: none; color: white;"><button class="btn btn-warning" style="margin-top: 16px; width:160px;"><i class="fa fa-globe"></i> Exporter follow-up</button></a>
                
                <a href="admin-profile" style="text-decoration: none; color: white;"><button class="btn btn-primary" style="margin-top: 16px; width:160px;"><i class="fa fa-database"></i> Access Database</button></a>
                
                <a href="admin-holidays" style="text-decoration: none; color: white;"><button class="btn btn-danger" style="margin-top: 16px; width:160px;"><i class="fa fa-bell"></i> Add/Delete Holidays</button></a>
                
                <a href="admin-usdFwdRate" style="width:150px; text-decoration: none; color: white;"><button style="width:160px; margin-top: 16px;" class="btn btn-success"><i class="fa fa-money"></i> Final Spot Forward</button></a>
                
                <a href="admin-forecast" style="text-decoration: none; color: white;"><button style="width:160px; margin-top: 16px;" class="btn btn-info"><i class="fa fa-line-chart"></i> Forecast</button></a>
                
                <a href="admin-tom" style="text-decoration: none; color: white;"><button style="width:160px; margin-top: 16px;" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Cash Tom</button></a>
                
                <a href="admin-curr-forecast" style="text-decoration: none; color: white;"><button style="width:250px; margin-top: 16px;" class="btn btn-info"><i class="fa fa-bar-chart"></i> Update Currency Forecast</button></a>
              </div>
            </div>
          </div>
	    </div>
      </div>
      

	</div> <!--/Right Column Notification -->	

  </div><!--/container-fluid-->

  <footer class="navbar-fixed-bottom">   
  <?php
    include_once("include/footer.php");
  ?>
  </footer>
      
  </main>
</body>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery3.5.1.min.js"></script>
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

    <script>
    if (localStorage.getItem("preValA") != null) { 
        var actval = localStorage.getItem("preValA"); 
	if(actval != "2"){
          document.getElementById("d-"+actval).style.display = "block"; //show 
	  document.getElementById("t-"+actval).className += " active"; //nav active
          document.getElementById("d-2").style.display = "none"; //show 
	  document.getElementById("t-2").className = document.getElementById("t-2").className.replace(" active", ""); //hide active class
	}
    }else{ 
        localStorage.setItem("preValA", "2"); 
       // document.getElementById("d-"+actval).style.display = "block"; //show dashboard
       // document.getElementById("t-"+actval).className += " active"; //dashboard nav active
    }	    

    function onNavClick(val){
      var pVal = localStorage.getItem("preValA");

      if(pVal != val){
        localStorage.setItem("preValA", val);
	document.getElementById("d-"+pVal).style.display = "none"; //show dashboard
	document.getElementById("t-"+pVal).className = document.getElementById("t-"+pVal).className.replace(" active", ""); //hide active class

        document.getElementById("d-"+val).style.display = "block"; //show new section
        document.getElementById("t-"+val).className += " active"; //new nav active
      }
    }
    </script>  

</html>
