<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  
  $successProf="";
  $errorProf="";
  $successFeed="";
  $errorFeed="";
  $errorFwdInfo="";
  $successFwdInfo="";
  $val=0;
  
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
    if($_SESSION['sessCustomerID'] == "7"){
        header("Location: admin-account.php"); 
        exit();
    }
  }
  
  include("check-FXPRESS.php");
?>

<?php
if(isset($_SESSION['useremail'])){
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
  include("dashboard/updateProfPass.php");
  include("dashboard/sendFeedback.php");
  
  include("dashboard/updateFwdContract.php");
  include("dashboard/getBidAsk.php");
?>

<?php
  $succ = "";
  $err = "";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  }else{
    $succ = "Connection established";
  } 

  $query0 = "SELECT id, month, settleDate, bidPrem, askPrem, bidPremEUR, askPremEUR, bidPremGBP, askPremGBP FROM usdFwdRate";
  $result0 = $conn->query($query0);
  $arrayBid = array();
  $arrayAsk = array();

  $arrayBidEUR = array();
  $arrayAskEUR = array();

  $arrayBidGBP = array();
  $arrayAskGBP = array();

  $endSettleDate;
  
  while($row0 = $result0->fetch_assoc()){ 
      
    $arrDateSettle = date("d-m-Y", strtotime($row0['settleDate']));
    $arrayBid[$arrDateSettle] = $row0['bidPrem'];
    $arrayAsk[$arrDateSettle] = $row0['askPrem'];
    
    $arrayBidEUR[$arrDateSettle] = $row0['bidPremEUR'];
    $arrayAskEUR[$arrDateSettle] = $row0['askPremEUR'];
    
    $arrayBidGBP[$arrDateSettle] = $row0['bidPremGBP'];
    $arrayAskGBP[$arrDateSettle] = $row0['askPremGBP'];
    
    $endSettleDate = date("d-m-Y", strtotime($row0['settleDate']));
  }	

  //print_r($arrayBid);
  
  $query = "SELECT holiday FROM holidays ORDER BY holiday ASC";
  $result = $conn->query($query);
	
  $d=0;
  $listHoliday = array();
  
  while($row = $result->fetch_assoc()){ 
    $d++;
    $hd=$row['holiday'];
    $splitIt = explode("-", $hd);
     
    $newKey = $splitIt[2].'-'.$splitIt[1].'-'.$splitIt[0];
    
    $listHoliday[$newKey]=1;
  }
   
  //print_r($listHoliday);
   
  $conn->close();
  
  $dateToday = new DateTime('today');
  $tday = new DateTime('today'); 
  
  $tday->format('d-m-Y');
  
  $dt = new DateTime('today + 3 day'); 
  
  $countSettleDt=0;
  $mainSettleDt=new DateTime('today');
  $minDay='';
  $maxDay='';
  
  while($countSettleDt<2){
    $mainSettleDt->modify('+1 day');  
    
    if(array_key_exists($mainSettleDt->format('d-m-Y'), $listHoliday) == 1){
       
    }else{
      $countSettleDt++;    
    } 
  }
    
  $arrDay = array();
  
  $arrDay[0]=new DateTime($mainSettleDt->format('d-m-Y'));
  
  for($k=0; $k<12; $k++){
    $tempArrDay0=new DateTime($mainSettleDt->format('d-m-Y'));  
    $m=$k+1;
    $tempArrDay0->modify('+'.$m.' month');
    
    $countSettleDt=0;
    while(1){
      if(array_key_exists($tempArrDay0->format('d-m-Y'), $listHoliday) == 1){
        $tempArrDay0->modify('+1 day');  
      }else{
        break;    
      }
    }
    $arrDay[$k]=$tempArrDay0->format('d-m-Y');    
  }
  
  $mainFwdStartDt=new DateTime($mainSettleDt->format('d-m-Y'));
  $countFwdSDt=0;
  while($countFwdSDt<1){
    $mainFwdStartDt->modify('+1 day');  
    
    if(array_key_exists($mainFwdStartDt->format('d-m-Y'), $listHoliday) == 1){
       
    }else{
      $countFwdSDt++;    
    }       
  }
  
  $dateToday = new DateTime('today');

  $minDay = $mainFwdStartDt->format('d-m-Y');
  $maxDay = $endSettleDate; 

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
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
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
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="bower_components/jquery-ui/jquery-ui.css"> 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  
  
   <script>
    var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
    var bidArray = <?php echo json_encode($arrayBid); ?>;
    var askArray = <?php echo json_encode($arrayAsk); ?>;
    
    function getDateNow(){
      var today = new Date();
      var dd = today.getDate();

      var mm = today.getMonth()+1; 
      var yyyy = today.getFullYear();
      if(dd<10) 
      {
        dd='0'+dd;
      } 

      if(mm<10) 
      {
        mm='0'+mm;
      } 
      today = dd+'-'+mm+'-'+yyyy;
      
      return today;
    }

    function CalSpotFwdBidSample(n, rid, seld, selm, sely, amtf, ratef){ 
        var bid;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;

        ds_ = new Date(sely, selm-1, seld);
        ds_.setHours(0,0,0,0);
        
		var bidArray = <?php echo json_encode($arrayBid); ?>;
		
		if(n == 1){
			bodyText = <?php echo $bidUSD; ?> ;
			bidArray = <?php echo json_encode($arrayBid); ?>;
		}else if(n == 2){
			bodyText = <?php echo $bidEUR; ?> ;
			bidArray = <?php echo json_encode($arrayBidEUR); ?>;			
		}else if(n == 3){
			bodyText = <?php echo $bidGBP; ?> ;
			bidArray = <?php echo json_encode($arrayBidGBP); ?>;
		}else{
			return;
		}		
        
        //bodyText = bodyText.replace(re, '');
        bid = parseFloat(bodyText);
        
        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        var fs_ = new Date(fs); //Forward Start Date
        fs_.setHours(0,0,0,0);
        
        var dprev_ = fs_; // date prev month = forward start date (Initially)
        var dnext_; // this will be set in for loop (see next)
        var pprev_ = 0; // forward premium = 0 (Initially)
        var pnext_ = 0; // this will be set in for loop (see next)
        var fwdprem = 0;
        var spotFwdRate = 0;
        var flag = 0 ; // got the final spot fwd rate
        
        for( var key in bidArray ) {
            var value = bidArray[key];
            
            sd = key.toString().split('-');
            
            sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
            
            sd_.setHours(0,0,0,0);
            
            dnext_ = sd_; // bidArray key is settlement date = date next 
            ddiff_ = parseInt((ds_ - dprev_)/(1000 * 60 * 60 * 24))+1; 
            pnext_ = parseFloat(value);
            dp_ = parseFloat(pnext_ - pprev_); // difference premium
            dmdiff_ = parseInt((dnext_ - dprev_)/(1000 * 60 * 60 * 24))+1;
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                spotFwdRate = parseFloat(parseFloat(bid) + fwdprem/100).toFixed(4);  
                
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        finalValBid = 0;
        if(flag == 1){
            finalValBid = parseFloat(spotFwdRate).toFixed(4);
        }else{
            finalValBid = parseFloat(bid).toFixed(4);
        }
        
        profitloss = parseFloat((parseFloat(finalValBid)-parseFloat(ratef)) * parseFloat(amtf)).toFixed(2);
        
        var iy = "idt-"+rid;
        
        document.getElementById(iy).innerHTML = profitloss;
    }
    
    function CalSpotFwdAskSample(n, rid, seld, selm, sely, amtf, ratef){  
        var ask;
        var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
        var bodyText;
        
        ds_ = new Date(sely, selm-1, seld);
        ds_.setHours(0,0,0,0);
        
        var askArray = <?php echo json_encode($arrayAsk); ?>;
		
		if(n == 1){
			bodyText = <?php echo $askUSD; ?> ;
			askArray = <?php echo json_encode($arrayAsk); ?>;
		}else if(n == 2){
			bodyText = <?php echo $askEUR; ?> ;
			askArray = <?php echo json_encode($arrayAskEUR); ?>;			
		}else if(n == 3){
			bodyText =  <?php echo $askGBP; ?> ;
			askArray = <?php echo json_encode($arrayAskGBP); ?>;
		}else{
			return;
		}	
	
        //bodyText = bodyText.replace(re, '');
        ask = parseFloat(bodyText);
		
        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
        var fs_ = new Date(fs); //Forward Start Date
        fs_.setHours(0,0,0,0);
        
        var dprev_ = fs_; // date prev month = forward start date (Initially)
        var dnext_; // this will be set in for loop (see next)
        var pprev_ = 0; // forward premium = 0 (Initially)
        var pnext_ = 0; // this will be set in for loop (see next)
        var fwdprem = 0;
        var spotFwdRate = 0;
        var flag = 0 ; // got the final spot fwd rate
        
        for( var key in askArray ) {
            var value = askArray[key];
            
            sd = key.toString().split('-');
            
            sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
            
            sd_.setHours(0,0,0,0);
            
            dnext_ = sd_; // askArray key is settlement date = date next 
            ddiff_ = parseInt((ds_ - dprev_)/(1000 * 60 * 60 * 24))+1; 
            pnext_ = parseFloat(value);
            dp_ = parseFloat(pnext_ - pprev_); // difference premium
            dmdiff_ = parseInt((dnext_ - dprev_)/(1000 * 60 * 60 * 24))+1;
            
            if(ds_ >= dprev_ && ds_ <= dnext_){
                fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));
                
                spotFwdRate = parseFloat(parseFloat(ask) + fwdprem/100).toFixed(4);  
               
                flag = 1;        
                break;
            }
            
            dprev_ = dnext_;
            pprev_ = pnext_;
        }
        
        
        finalValAsk = 0;
        if(flag == 1){
            finalValAsk = parseFloat(spotFwdRate).toFixed(4);
        }else{
            finalValAsk = parseFloat(ask).toFixed(4);
        }
        
        profitloss = parseFloat((parseFloat(ratef) - parseFloat(finalValAsk)) * parseFloat(amtf)).toFixed(2);
        
        var iy = "idt-"+rid;
        
        document.getElementById(iy).innerHTML = profitloss;
    }
    
  </script>

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
    
    .form-group-inline {
  display: inline-block;
}

.form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
    margin-left: 5px;
}

.form-control-small {
  min-width: 40px;
  max-width: 50px;
}

.form-control-medium {
  min-width: 200px;
  max-width: 250px;
}

.form-control-large {
  min-width: 400px;
  max-width: 500px;
}
.label-block {
  display: block;
  margin-left: 5px;
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
		  <a id="t-1" onclick="onNavClick('1')" href="#" id="1" class="list-group-item"><i class="fa fa-user"></i> <strong>Profile</strong></a>
		  <a id="t-2" onclick="onNavClick('2')" href="#" id="2" class="list-group-item active"><i class="fa fa-credit-card"></i> <strong>Your Subscriptions</strong></a>
		  <a id="t-3" onclick="onNavClick('3')" href="#" id="3" class="list-group-item"><i class="fa fa-mail-forward"></i> <strong>Notifications</strong></a>
		  <a id="t-4" onclick="onNavClick('4')" href="#" id="4" class="list-group-item"><i class="fa fa-envelope"></i> <strong>Send Feedback</strong></a>
		  <a id="t-5" onclick="onNavClick('5')" href="#" id="5" class="list-group-item"><i class="fa fa-money"></i> <strong>Forward Contract </strong> <i class="fa fa-star" style="color: orange;"></i></a>
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
				  <input readonly maxlength="50" type="email" class="form-control" id="uemail" name="uemail" placeholder="Email" value="<?php echo $_SESSION['useremail']; ?>">
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
		  
		</div>
    </div><!--/Right Column Profile-->
   </div>

	<!-- Right Column Dashboard -->
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
                $query = "SELECT * FROM subscription WHERE customer_id='$custId' ORDER BY id DESC"; 
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
                      
                    case "7":
                      $pname="FXPRESS";
                      break;  

                    default:
                      $pname="";
                  }   
                  
                  if($pname!="" && $row2['status']!="NOTAVAILABLE")
                    echo "<tr><td>" . $row2['order_id'] . "</td><td>" . $pname . "</td><td>" . date("d-m-Y", strtotime($row2['paid_on'])) . "</td><td>" . date("d-m-Y", strtotime($row2['expire_on'])) . "</td><td>" . $row2['status'] . "</td></tr>"; 
                }
                $conn->close();
                ?>
              </table>
            </div>
            <!-- /.box-body -->

	  </div>

	  </div>
			
	  <p><a href="https://ibrlive.com/our-products" class="text-decoration-none"><button class="btn btn-warning">Click to add subscriptions</button></a></p>
	  	  <?php
	  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "628"){
        ?>
        <a href="admin-curr-forecast" style="text-decoration: none; color: white;"><button style="width:250px; margin-top: 16px;" class="btn btn-info"><i class="fa fa-bar-chart"></i> Update Currency Forecast</button></a>
        <?php
    }
  }
	  
	  ?>
	</div><!--/Right Column Dashboard -->

	<!-- Right Column Notification -->
    <div class="col-sm-10 shiftb80 leftNavDefault" id="d-3">
	  <div class="panel panel-primary panelBorderColor">
            <div class="panel-heading">
              <h1 class="panel-title"><span class="glyphicon glyphicon-envelope"></span> Your Inbox</h1>
            </div>
			
            <div class="panel-body">
            <div class="list-group">
                <div class="row">
                  <div class="col-sm-6">
                    <label style="margin-right: 8px;" class="">
                      <div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" id="check-all" class="icheck" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                    </label>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						Action <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Mark as read</a></li>
                        <li><a href="#">Mark as unread</a></li>
                        <li><a href="#">Mark as important</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Report spam</a></li>
                        <li><a href="#">Delete</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col-md-6 search-form">
                    <form action="#" class="text-right">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" placeholder="Search">
                          <span class="input-group-btn">
                          <button type="submit" name="search" class="btn_ btn-primary btn-sm search"><i class="fa fa-search"></i></button></span>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="padding"></div>
		<div class="table-responsive table-bordered">
                    <table class="table">
                      <thead>
                        <tr>
                          <td class="action"></td>
                          <td class="action"></td>
                          <td class="action"></td>
                          <td class="name"><strong>From</strong></td>
                          <td class="subject"><strong>Subject</strong></td>
                          <td class="time"><strong>Date and Time</strong></td>
                        </tr>
                      </thead>
		      <tbody>

		        <tr>
			  <td class="text-info" colspan="7">No message available</td>			
		        </tr>			
                      </tbody>
                    </table>
                </div>

                <ul class="pagination">
		    <li class="disabled"><a href="#">«</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
	  </div>
          </div>              
	</div> <!--/Right Column Notification -->	

	<!-- Right Column Feedback -->
	<div class="col-sm-10 shiftb80 leftNavDefault" id="d-4">
	  <div class="panel panel-primary panelBorderColor">
		<div class="panel-heading">
		  <h3 class="panel-title">
			<span class="glyphicon glyphicon-envelope"> </span> 
			Submit Your Feedback
		  </h3>
		</div>
		<div class="panel-body">
		  <!-- Alert -->
		  <?php
          	  if($successFeed != ""){
	          ?>
          	    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <strong>Success:</strong> <?php echo $successFeed; $successFeed=""?>
          	    </div>
         	  <?php
          	  } else if($errorFeed != "") {
          	  ?>
          	    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error:</strong> <?php echo $errorFeed; $errorFeed="" ?>
          	  </div>
          	  <?php
          	  }
          	  ?>
		  <form action="" method="POST">						
			<div class="form-group">
			  <label for="utopic">Topic &#42;</label>
			  <input required maxlength="100" type="text" class="form-control" id="utopic" name="utopic" placeholder="Topic of your feedback">
			</div>
			<div class="form-group">
			  <label for="uquery">Your Feedback &#42;</label>
			  <textarea rows="6" required maxlength="500" style="resize: none;" type="text" class="form-control" id="uquery" name="uquery" placeholder="Your Feedback (Max 500 words)"></textarea>
			</div>

			<button type="submit" name="sendFeedback" class="btn btn-warning">Submit</button>
		  </form>
		</div>
	  </div>	
	</div><!--/Right Column Feedback -->
	
	<div class="modal fade" id="editInfo">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Information</h4>
          </div>
          <form action="" class="form-horizontal" role="form" method="post" name="submitEditRequest">
	      <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="fpair" class="col-sm-4 control-label">Currency *</label>

                <div class="col-sm-8">
				  <select required class="form-control" id="fpair" name="fpair">
			        <option value="">Select Pair</option>
			        <option value="USD/INR">USD/INR</option>
			        <option value="EUR/INR">EUR/INR</option>
			        <option value="GBP/INR">GBP/INR</option>
			      </select>
                </div>
			  </div>

              <div class="form-group">
                <label for="fbank" class="col-sm-4 control-label">Bank</label>

                <div class="col-sm-8">
				  <select class="form-control" id="fctype" name="fbank">
				      
			        <option value="">Select Bank</option>
<option value="Axis">Axis &ndash; Axis Bank Ltd.</option>
<option value="Bandhan">Bandhan &ndash; Bandhan Bank Ltd.</option>
<option value="CSB">CSB &ndash; CSB Bank Ltd.</option>
<option value="CUB">CUB &ndash; City Union Bank Ltd.</option>
<option value="DCB">DCB &ndash; DCB Bank Ltd.</option>
<option value="DBL">DBL &ndash; Dhanlaxmi Bank Ltd.	</option>
<option value="Federal">Federal &ndash; Federal Bank Ltd.</option>
<option value="HDFC">HDFC &ndash; HDFC Bank Ltd.</option>
<option value="ICICI">ICICI &ndash; ICICI Bank Ltd.</option>
<option value="Indusind">Indusind &ndash; IndusInd Bank Ltd.</option>
<option value="IDFC">IDFC &ndash; IDFC FIRST Bank Ltd.</option>
<option value="J&K">J&K &ndash; Jammu & Kashmir Bank Ltd.</option>
<option value="Karnataka">Karnataka &ndash; Karnataka Bank Ltd.</option>
<option value="KVB">KVB &ndash; Karur Vysya Bank Ltd.</option>
<option value="Kotak">Kotak &ndash; Kotak Mahindra Bank Ltd.</option>
<option value="LVB">LVB &ndash; Lakshmi Vilas Bank Ltd.</option>
<option value="Nainital">Nainital &ndash; Nainital bank Ltd.</option>
<option value="RBL">RBL &ndash; RBL Bank Ltd.</option>
<option value="SIB">SIB &ndash; South Indian Bank Ltd.</option>
<option value="Tamilnad">Tamilnad &ndash; Tamilnad Mercantile Bank Ltd.</option>
<option value="Yes">Yes &ndash; YES Bank Ltd.</option>
<option value="IDBI">IDBI &ndash; IDBI Bank Ltd.</option>
<option value="BOB">BOB &ndash; Bank of Baroda</option>
<option value="BOI">BOI &ndash; Bank of India</option>
<option value="BOM">BOM &ndash; Bank of Maharashtra	</option>
<option value="Canara">Canara &ndash; Canara Bank</option>
<option value="CBI">CBI &ndash; Central Bank of India</option>
<option value="Indian">Indian &ndash; Indian Bank</option>
<option value="IOB">IOB &ndash; Indian Overseas Bank</option>
<option value="P&S">P&S &ndash; Punjab & Sind Bank</option>
<option value="PNB">PNB &ndash; Punjab National Bank</option>
<option value="SBI">SBI &ndash; State Bank of India	</option>
<option value="UCO">UCO &ndash; UCO Bank</option>
<option value="UBI">UBI &ndash; Union Bank of India</option>
<option value="Deutsche">Deutsche &ndash; Deutsche Bank</option>
<option value="HSBC">HSBC &ndash; HSBC Ltd.</option>
<option value="DBS">DBS &ndash; DBS Bank Ltd.</option>
<option value="Shinhan">Shinhan &ndash; Shinhan Bank</option>
<option value="Woori">Woori &ndash; Woori Bank</option>
<option value="Barclays">Barclays &ndash; Barclays Bank Plc.</option>
<option value="SCB">SCB &ndash; Standard Chartered Bank</option>
<option value="AEB">AEB &ndash; American Express Banking Corp.</option>
<option value="BOA">BOA &ndash; Bank of America</option>
<option value="CITI">CITI &ndash; Citibank</option>
<option value="Chase">Chase &ndash; J.P. Morgan Chase Bank</option>

			      </select>
                </div>
			  </div>
			  
              <div class="form-group">
                <label for="famount" class="col-sm-4 control-label">Amount *</label>

                <div class="col-sm-8">
				  <input required type="text" minlength="1" maxlength="15" class="form-control" id="famount" name="famount" placeholder="Amount" pattern="^\d*(\.\d{0,4})?$" />
                </div>
			  </div>

              <div class="form-group">
                <label for="fctype" class="col-sm-4 control-label">Contract Type *</label>

                <div class="col-sm-8">
				  <select required class="form-control" id="fctype" name="fctype">
			        <option value="">Select Type</option>
			        <option value="Buy">Buy</option>
			        <option value="Sell">Sell</option>
			      </select>
                </div>
			  </div>

              <div class="form-group">
                <label for="fcno" class="col-sm-4 control-label">Contract Number *</label>

                <div class="col-sm-8">
				  <input required class="form-control" id="fcno" name="fcno" type="text" maxlength="15" placeholder="Contract Number" />
                </div>
			  </div>

              <div class="form-group">
                <label for="fbookdate" class="col-sm-4 control-label">Contract Book Date *</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" required="required" class="form-control" type="date" name="fbookdate" id="fbookdate">  
                </div>
			  </div>

              <div class="form-group">
                <label for="fcrate" class="col-sm-4 control-label">Contract Rate *</label>

                <div class="col-sm-8">
				  <input required type="text" minlength="1" maxlength="10" class="form-control" id="fcrate" name="fcrate" placeholder="Rate" pattern="^\d*(\.\d{0,4})?$" />
                </div>
			  </div>

              <div class="form-group">
                <label for="ffdate" class="col-sm-4 control-label">Contract Date From *</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" required="required" class="form-control" type="date" name="ffdate" id="ffdate">  
                </div>
			  </div>

              <div class="form-group">
                <label for="ftodate" class="col-sm-4 control-label">Contract Date To *</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" required="required" class="form-control" type="date" name="ftodate" id="ftodate">  
                </div>
			  </div>
			  
			  <div class="form-group">
                <label for="fddfrom" class="col-sm-4 control-label">Doc Delivery Date From</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" class="form-control" type="date" name="fddfrom" id="fddfrom">  
                </div>
			  </div>
			  
			  <div class="form-group">
                <label for="fddto" class="col-sm-4 control-label">Doc Delivery Date To</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" class="form-control" type="date" name="fddto" id="fddto">  
                </div>
			  </div>
			  
			  <div class="form-group">
                <label for="fspot" class="col-sm-4 control-label">Spot Rate</label>

                <div class="col-sm-8">
				  <input type="text" minlength="0" maxlength="15" class="form-control" id="fspot" name="fspot" placeholder="Spot Rate" pattern="^\d*(\.\d{0,4})?$" />
                </div>
			  </div>
			  
            </div>
            <!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
		    <button type="submit" name="addFwdContract" id="addFwdContract" value="Add Information" class="btn-upper btn btn-primary">Add Information</button>
          </div>
	      </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal edit info -->
    
	<div class="modal fade" id="addInfo">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Information</h4>
          </div>
          <form action="" class="form-horizontal" role="form" method="post" name="submitRequest">
	      <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="fpair" class="col-sm-4 control-label">Currency *</label>

                <div class="col-sm-8">
				  <select required class="form-control" id="fpair" name="fpair">
			        <option value="">Select Pair</option>
			        <option value="USD/INR">USD/INR</option>
			        <option value="EUR/INR">EUR/INR</option>
			        <option value="GBP/INR">GBP/INR</option>
			      </select>
                </div>
			  </div>

              <div class="form-group">
                <label for="fbank" class="col-sm-4 control-label">Bank</label>

                <div class="col-sm-8">
				  <select class="form-control" id="fctype" name="fbank">
				      
			        <option value="">Select Bank</option>
<option value="Axis">Axis &ndash; Axis Bank Ltd.</option>
<option value="Bandhan">Bandhan &ndash; Bandhan Bank Ltd.</option>
<option value="CSB">CSB &ndash; CSB Bank Ltd.</option>
<option value="CUB">CUB &ndash; City Union Bank Ltd.</option>
<option value="DCB">DCB &ndash; DCB Bank Ltd.</option>
<option value="DBL">DBL &ndash; Dhanlaxmi Bank Ltd.	</option>
<option value="Federal">Federal &ndash; Federal Bank Ltd.</option>
<option value="HDFC">HDFC &ndash; HDFC Bank Ltd.</option>
<option value="ICICI">ICICI &ndash; ICICI Bank Ltd.</option>
<option value="Indusind">Indusind &ndash; IndusInd Bank Ltd.</option>
<option value="IDFC">IDFC &ndash; IDFC FIRST Bank Ltd.</option>
<option value="J&K">J&K &ndash; Jammu & Kashmir Bank Ltd.</option>
<option value="Karnataka">Karnataka &ndash; Karnataka Bank Ltd.</option>
<option value="KVB">KVB &ndash; Karur Vysya Bank Ltd.</option>
<option value="Kotak">Kotak &ndash; Kotak Mahindra Bank Ltd.</option>
<option value="LVB">LVB &ndash; Lakshmi Vilas Bank Ltd.</option>
<option value="Nainital">Nainital &ndash; Nainital bank Ltd.</option>
<option value="RBL">RBL &ndash; RBL Bank Ltd.</option>
<option value="SIB">SIB &ndash; South Indian Bank Ltd.</option>
<option value="Tamilnad">Tamilnad &ndash; Tamilnad Mercantile Bank Ltd.</option>
<option value="Yes">Yes &ndash; YES Bank Ltd.</option>
<option value="IDBI">IDBI &ndash; IDBI Bank Ltd.</option>
<option value="BOB">BOB &ndash; Bank of Baroda</option>
<option value="BOI">BOI &ndash; Bank of India</option>
<option value="BOM">BOM &ndash; Bank of Maharashtra	</option>
<option value="Canara">Canara &ndash; Canara Bank</option>
<option value="CBI">CBI &ndash; Central Bank of India</option>
<option value="Indian">Indian &ndash; Indian Bank</option>
<option value="IOB">IOB &ndash; Indian Overseas Bank</option>
<option value="P&S">P&S &ndash; Punjab & Sind Bank</option>
<option value="PNB">PNB &ndash; Punjab National Bank</option>
<option value="SBI">SBI &ndash; State Bank of India	</option>
<option value="UCO">UCO &ndash; UCO Bank</option>
<option value="UBI">UBI &ndash; Union Bank of India</option>
<option value="Deutsche">Deutsche &ndash; Deutsche Bank</option>
<option value="HSBC">HSBC &ndash; HSBC Ltd.</option>
<option value="DBS">DBS &ndash; DBS Bank Ltd.</option>
<option value="Shinhan">Shinhan &ndash; Shinhan Bank</option>
<option value="Woori">Woori &ndash; Woori Bank</option>
<option value="Barclays">Barclays &ndash; Barclays Bank Plc.</option>
<option value="SCB">SCB &ndash; Standard Chartered Bank</option>
<option value="AEB">AEB &ndash; American Express Banking Corp.</option>
<option value="BOA">BOA &ndash; Bank of America</option>
<option value="CITI">CITI &ndash; Citibank</option>
<option value="Chase">Chase &ndash; J.P. Morgan Chase Bank</option>

			      </select>
                </div>
			  </div>
			  
              <div class="form-group">
                <label for="famount" class="col-sm-4 control-label">Amount *</label>

                <div class="col-sm-8">
				  <input required type="text" minlength="1" maxlength="15" class="form-control" id="famount" name="famount" placeholder="Amount" pattern="^\d*(\.\d{0,4})?$" />
                </div>
			  </div>

              <div class="form-group">
                <label for="fctype" class="col-sm-4 control-label">Contract Type *</label>

                <div class="col-sm-8">
				  <select required class="form-control" id="fctype" name="fctype">
			        <option value="">Select Type</option>
			        <option value="Buy">Buy</option>
			        <option value="Sell">Sell</option>
			      </select>
                </div>
			  </div>

              <div class="form-group">
                <label for="fcno" class="col-sm-4 control-label">Contract Number *</label>
 
                <div class="col-sm-8">
				  <input required class="form-control" id="fcno" name="fcno" type="text" maxlength="15" placeholder="Contract Number" />
                </div>
			  </div>

              <div class="form-group">
                <label for="fbookdate" class="col-sm-4 control-label">Contract Book Date *</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" required="required" class="form-control" type="date" name="fbookdate" id="fbookdate">  
                </div>
			  </div>

              <div class="form-group">
                <label for="fcrate" class="col-sm-4 control-label">Contract Rate *</label>

                <div class="col-sm-8">
				  <input required type="text" minlength="1" maxlength="10" class="form-control" id="fcrate" name="fcrate" placeholder="Rate" pattern="^\d*(\.\d{0,4})?$" />
                </div>
			  </div>

              <div class="form-group">
                <label for="ffdate" class="col-sm-4 control-label">Contract Date From *</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" required="required" class="form-control" type="date" name="ffdate" id="ffdate">  
                </div>
			  </div>

              <div class="form-group">
                <label for="ftodate" class="col-sm-4 control-label">Contract Date To *</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" required="required" class="form-control" type="date" name="ftodate" id="ftodate">  
                </div>
			  </div>
			  
			  <div class="form-group">
                <label for="fddfrom" class="col-sm-4 control-label">Doc Delivery Date From</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" class="form-control" type="date" name="fddfrom" id="fddfrom">  
                </div>
			  </div>
			  
			  <div class="form-group">
                <label for="fddto" class="col-sm-4 control-label">Doc Delivery Date To</label>

                <div class="col-sm-8">
				  <input autocomplete="off" style="cursor: pointer;" placeholder="Select Date" class="form-control" type="date" name="fddto" id="fddto">  
                </div>
			  </div>
			  
			  <div class="form-group">
                <label for="fspot" class="col-sm-4 control-label">Spot Rate</label>

                <div class="col-sm-8">
				  <input type="text" minlength="0" maxlength="15" value="0" class="form-control" id="fspot" name="fspot" placeholder="Spot Rate" pattern="^\d*(\.\d{0,4})?$" />
                </div>
			  </div>
			  
            </div>
            <!-- /.box-body -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
		    <button type="submit" name="addFwdContract" id="addFwdContract" value="Add Information" class="btn-upper btn btn-primary">Add Information</button>
          </div>
	      </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="checkAllFwd">
      <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Your All Forward Contracts</h4>
          </div>
          <form action="" class="form-horizontal" role="form" method="post" name="submitRequest">
	      <div class="modal-body">
            <div class="box-body">
          <div class="table-responsive table-bordered">
                
                <table class="table table-striped text-center table-bordered bg-info" id="fwdContractTableAll" style="width: 100%;">
                  <thead>
                      
                    <tr>
                      <th style="display: none;"><strong>cid</strong></th>
                      <th style="min-width: 5px;"><strong>#</strong></th>
                      <th style="min-width: 30px;"><strong>Pair</strong></th>
                      <th style="min-width: 50px;"><strong>Amount</strong></th>
                      <th style="min-width: 10px;"><strong>Type</strong></th>
                      <th style="min-width: 80px;"><strong>Contract No</strong></th>
                      <th style="min-width: 50px;"><strong>Booked On</strong></th>
                      <th style="min-width: 20px;"><strong>Rate</strong></th>
                      <th style="min-width: 50px;"><strong>Contract Date</strong></th>
                      <th style="min-width: 90px;"><strong>Amount (INR)</strong></th>
                      <th style="min-width: 10px;"><strong>Utilized?</strong></th>
                      <th style="min-width: 10px;"><strong>Bank</strong></th>
                      <th style="min-width: 10px;"><strong>Spot Rate</strong></th>
                      <th style="min-width: 10px;"><strong>Premium</strong></th>
                      <th style="min-width: 50px;"><strong>Doc Delivery Date</strong></th>
                      <th style="min-width: 10px;"><strong>Period (Month/Days)</strong></th>
                      <th style="min-width: 5px;"><strong>Delete</strong></th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php
                  //Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }   
    
                  $custId= $_SESSION['userid'];
                  $qry = "SELECT * FROM fwdContract WHERE userID='$custId' ORDER BY cfrom ASC"; 
                  $res = $conn->query($qry);
	
	              
                  while($rw = $res->fetch_assoc()){  
                    $currpair="";
                    $buysell="";
                    switch($rw['pair']){
                      case "USD/INR":
                        $currpair=1;
                        if($rw['type']=="Sell"){
                            $buysell="1";
                        }else{
                            if($rw['type']=="Buy"){
                                $buysell="2";
                            }
                        }
                      break;    
                            
                      case "EUR/INR":
                        $currpair=2;
                        if($rw['type']=="Sell"){
                            $buysell="1";
                        }else{
                          if($rw['type']=="Buy"){
                              $buysell="2";
                          }
                        }
                      break;
                            
                      case "GBP/INR":
                        $currpair=3;
                        if($rw['type']=="Sell"){
                            $buysell="1";
                        }else{
                          if($rw['type']=="Buy"){
                              $buysell="2";
                          }
                        }
                      break;
                    }
                    
                    
                    $dateFrom = new DateTime($rw['cfrom']); 
                    $dateTo = new DateTime($rw['cto']); 
                    $dateBook = new DateTime($rw['cbook']);
                    $dnow_ = new DateTime();   
                    $dtocomp = new DateTime($rw['cto']);
                    
                    $period  = $dateFrom->diff($dateBook)->format('%a');
                    
                    if($rw['spot'] != 0 && $period != 0)
                    $prem = (($rw['crate'] - $rw['spot'])*360*100)/($rw['spot']* $period);
                    else
                    $prem=0;
                    
                    $prem = round($prem, 2) . " %";
                    
                    if($rw['ddfrom']){
                    $fdddateFrom = new DateTime($rw['ddfrom']); 
                    }else{
                    $fdddateFrom = "";    
                    }
                    
                    if($rw['ddto']){
                    $fdddateTo = new DateTime($rw['ddto']); 
                    }else{
                    $fdddateTo = "";    
                    }
                    
                    $splitItCTO = explode("-", $rw['cto']);
                    $newKeyCTO = $splitItCTO[2].'-'.$splitItCTO[1].'-'.$splitItCTO[0];
                    
                    $splitItCFROM = explode("-", $rw['cfrom']);
                    $newKeyCFROM = $splitItCFROM[2].'-'.$splitItCFROM[1].'-'.$splitItCFROM[0];
                  ?>
                  
                  <tr>
                      <td></td>
                      <td style="display: none;"><?php echo $rw['id']; ?></td>
                      <td><?php echo $rw['pair']; ?></td>
                      <td><?php echo round($rw['amount'], 2); ?></td>
                      <td><?php echo $rw['type']; ?></td>
                      <td><?php echo $rw['cnumber']; ?></td>
                      <td><?php echo $dateBook->format('d-m-Y'); ?></td>
                      <td><?php echo $rw['crate']; ?></td>
                      <td><?php echo $dateFrom->format('d-m-Y'); ?> <br/>to<br/> <?php echo $dateTo->format('d-m-Y'); ?></td>
                      <td><?php echo $rw['amount']*$rw['crate']; ?></td>
                      
                      <td>

                      <?php if($dnow_ < $dtocomp){ ?>      
                        <select required class="form-control" id="futilizedz" name="futilizedz" onchange="updateUtilized(<?php echo $rw['id']?>, this.value)">
			                <option value="1" <?php if($rw['utilized']=="1") echo 'selected="selected"'; ?> >Yes</option>
			                <option value="0" <?php if($rw['utilized']=="0") echo 'selected="selected"'; ?> >No</option>
			            </select>
			          <?php
                      }else{
			          ?>
			            <p>Contract Expired</p>
			          <?php
                      }
			          ?>
			          
                      </td>
                      <td><?php echo $rw['bank']; ?></td>
                      <td><?php echo $rw['spot']; ?></td>
                      <td><?php echo $prem; ?></td>
                      
                      <td><?php 
                      if($rw['ddfrom']!="0000-00-00"){ 
                        echo $fdddateFrom->format('d-m-Y'); 
                        echo "<br/>to<br/>";
                      } else { 
                        echo "";
                      } ?> 
                      
                      <?php 
                      if($rw['ddto']!="0000-00-00") 
                        echo $fdddateTo->format('d-m-Y'); 
                      else 
                        echo ""; ?>
                      </td>
                      
                      <td><?php echo $period; ?></td>
                      
                      <td style="cursor: pointer;" onclick="deleteRow(<?php echo $rw['id']?>)"><i class="fa fa-trash text-danger"></i></td>
                  </tr>
                  
                  <?php    
                  }
                  $conn->close();
                  ?>      
                  </tbody>     
                  
                  <tfoot>
                    <tr style="font-size: 16px;" class="bg-warning"> 
                      <th colspan="7"><strong>Total (This Page)</strong></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    
                    <tr style="font-size: 16px;" class="bg-info"> 
                      <th colspan="7"><strong>Grand Total</strong></th>
                      <th></th>
                      <th id="gtAmount2"></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>      
                </table>
            </div>

            </div>
            <!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
	      </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
	<!-- Right Column Progress -->
    <div class="col-sm-10 shiftb80 leftNavDefault" id="d-5">  
      <div class="panel panel-primary panelBorderColor">
        <div class="panel-heading">
          <h1 class="panel-title"><span class="glyphicon glyphicon-signal"></span> Forward Contract</h1>
        </div>

        <?php 
        if($allowFC=="YES"){
        ?>
        <div class="panel-body"> 
          	  
          <button style="margin-top: 5px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#addInfo"><i class="fa fa-plus"></i> Add Contract Information</button>
          <button style="margin-top: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkAllFwd"><i class="fa fa-list"></i> See All Forward Contracts</button>
          <hr>
          <p style="background-color: #337ab7; padding: 10px; color: white;"><strong>Your Active Forward Contracts </strong> <i class="fa fa-angle-double-down"></i> </p>
          <p class="text-center" readonly id="viewProfLoss" name="viewProfLoss" style="color: #337ab7; padding: 5px; border-style: double; font-weight: bold; font-size: 16px;" /></p>
          <button class="btn btn-warning" onclick="window.location.reload();"> <i class="fa fa-refresh"></i> Click to Refresh</button>

          <div class="table-responsive table-bordered">
                
                <table class="table table-striped text-center table-bordered bg-info" id="fwdContractTable" style="width: 100%;">
                  <thead>
                      
                    <tr>
                      <th style="display: none;"><strong>cid</strong></th>
                      <th style="min-width: 5px;"><strong>#</strong></th>
                      <th style="min-width: 30px;"><strong>Pair</strong></th>
                      <th style="min-width: 50px;"><strong>Amount</strong></th>
                      <th style="min-width: 10px;"><strong>Type</strong></th>
                      <th style="min-width: 80px;"><strong>Contract No</strong></th>
                      <th style="min-width: 50px;"><strong>Booked On</strong></th>
                      <th style="min-width: 20px;"><strong>Rate</strong></th>
                      <th style="min-width: 50px;"><strong>Contract Date</strong></th>
                      <th style="min-width: 90px;"><strong>Amount (INR)</strong></th>
                      <th style="min-width: 80px;"><strong>Profit/Loss</strong></th>
                      <th style="min-width: 10px;"><strong>Utilized?</strong></th>
                      <th style="min-width: 10px;"><strong>Bank</strong></th>
                      <th style="min-width: 10px;"><strong>Spot Rate</strong></th>
                      <th style="min-width: 10px;"><strong>Premium</strong></th>
                      <th style="min-width: 50px;"><strong>Doc Delivery Date</strong></th>
                      <th style="min-width: 10px;"><strong>Period (Month/Days)</strong></th>
                      <th style="min-width: 5px;"><strong>Delete</strong></th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php

                  //Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }   
    
                  $dnow = date("Y-m-d");    
                  
                  $custId= $_SESSION['userid'];
                  $qry = "SELECT * FROM fwdContract WHERE userID='$custId' AND utilized='0' AND cto > '$dnow' ORDER BY cfrom ASC"; 
                  $res = $conn->query($qry);
	
	              
                  while($rw = $res->fetch_assoc()){  
                    $currpair="";
                    $buysell="";
                    switch($rw['pair']){
                      case "USD/INR":
                        $currpair=1;
                        if($rw['type']=="Sell"){
                            $buysell="1";
                        }else{
                            if($rw['type']=="Buy"){
                                $buysell="2";
                            }
                        }
                      break;    
                            
                      case "EUR/INR":
                        $currpair=2;
                        if($rw['type']=="Sell"){
                            $buysell="1";
                        }else{
                          if($rw['type']=="Buy"){
                              $buysell="2";
                          }
                        }
                      break;
                            
                      case "GBP/INR":
                        $currpair=3;
                        if($rw['type']=="Sell"){
                            $buysell="1";
                        }else{
                          if($rw['type']=="Buy"){
                              $buysell="2";
                          }
                        }
                      break;
                    }
                    
                    
                    $dateFrom = new DateTime($rw['cfrom']); 
                    $dateTo = new DateTime($rw['cto']); 
                    $fdddateFrom = new DateTime($rw['ddfrom']); 
                    $fdddateTo = new DateTime($rw['ddto']); 
                    $dateBook = new DateTime($rw['cbook']);
                     
                    $period  = $dateFrom->diff($dateBook)->format('%a');
                    
                    if($rw['spot'] != 0 && $period != 0)
                    $prem = (($rw['crate'] - $rw['spot'])*360*100)/($rw['spot']* $period);
                    else
                    $prem=0;
                    
                    $prem = round($prem, 2) . " %";
                    
                    if($rw['ddfrom']){
                    $fdddateFrom = new DateTime($rw['ddfrom']); 
                    }else{
                    $fdddateFrom = "";    
                    }
                    
                    if($rw['ddto']){
                    $fdddateTo = new DateTime($rw['ddto']); 
                    }else{
                    $fdddateTo = "";    
                    }
                    
                    $splitItCTO = explode("-", $rw['cto']);
                    $newKeyCTO = $splitItCTO[2].'-'.$splitItCTO[1].'-'.$splitItCTO[0];
                    
                    $splitItCFROM = explode("-", $rw['cfrom']);
                    $newKeyCFROM = $splitItCFROM[2].'-'.$splitItCFROM[1].'-'.$splitItCFROM[0];
                  ?>
                  
                  <tr>
                      <td></td>
                      <td style="display: none;"><?php echo $rw['id']; ?></td>
                      <td><?php echo $rw['pair']; ?></td>
                      <td><?php echo round($rw['amount'], 2); ?></td>
                      <td><?php echo $rw['type']; ?></td>
                      <td><?php echo $rw['cnumber']; ?></td>
                      <td><?php echo $dateBook->format('d-m-Y'); ?></td>
                      <td><?php echo $rw['crate']; ?></td>
                      <td><?php echo $dateFrom->format('d-m-Y'); ?> <br/>to<br/> <?php echo $dateTo->format('d-m-Y'); ?></td>
                      <td><?php echo $rw['amount']*$rw['crate']; ?></td>
                      <td id="idt-<?php echo $rw['id'];?>"></td>
                      
                      <td>
                        <select required class="form-control" id="futilized" name="futilized" onchange="updateUtilized(<?php echo $rw['id']?>, this.value)">
			                <option value="1" <?php if($rw['utilized']=="1") echo 'selected="selected"'; ?> >Yes</option>
			                <option value="0" <?php if($rw['utilized']=="0") echo 'selected="selected"'; ?> >No</option>
			            </select>  
                      </td>
                      <td><?php echo $rw['bank']; ?></td>
                      <td><?php echo $rw['spot']; ?></td>
                      <td><?php echo $prem; ?></td>
                      
                      <td><?php 
                      if($rw['ddfrom']!="0000-00-00")
                      { 
                        echo $fdddateFrom->format('d-m-Y'); 
                        echo "<br/>to<br/>";
                      } else { 
                        echo "";
                      } ?> 
                      
                      <?php 
                      if($rw['ddto']!="0000-00-00") 
                        echo $fdddateTo->format('d-m-Y'); 
                      else echo ""; 
                      ?>
                      </td>
                      
                      <td><?php echo $period; ?></td>
                      <td style="cursor: pointer;" onclick="deleteRow(<?php echo $rw['id']?>)"><i class="fa fa-trash text-danger"></i></td>
                  </tr>
                  
                  <?php if($buysell == "1") {
                  ?>
                  <script> CalSpotFwdAskSample(<?php echo $currpair; ?>, <?php echo $rw['id']; ?> , <?php echo $splitItCFROM[2]; ?>, <?php echo $splitItCFROM[1]; ?>, <?php echo $splitItCFROM[0]; ?> , <?php echo $rw['amount']; ?>, <?php echo $rw['crate']; ?>); </script>
                  <?php
                  } else {
                     if($buysell == "2") {
                  ?>
                       <script> CalSpotFwdBidSample(<?php echo $currpair; ?>, <?php echo $rw['id']; ?> , <?php echo $splitItCTO[2]; ?>, <?php echo $splitItCTO[1]; ?>, <?php echo $splitItCTO[0]; ?> , <?php echo $rw['amount']; ?>, <?php echo $rw['crate']; ?>); </script>
                  <?php         
                     }
                  }
                  ?>
                  <?php    
                  }
                  $conn->close();
                  ?>      
                  </tbody>     
                  
                  <tfoot>
                    <tr style="font-size: 16px;" class="bg-warning"> 
                      <th colspan="7"><strong>Total (This Page)</strong></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>   
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    
                    <tr style="font-size: 16px;" class="bg-info"> 
                      <th colspan="7"><strong>Grand Total</strong></th>
                      <th></th>
                      <th id="gtAmount"></th>
                      <th id="gtProfitLoss"></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>      
                </table>
            </div>
	    </div> <!--/Panel Body -->
	    <?php 
        } else {
        ?>
        
        <div class="panel-body"> 
          <a href="our-products"><button style="margin-top: 5px;" type="button" class="btn btn-primary" ><i class="fa fa-shopping-cart"> </i> Purchase Subscription (FXPRESS)</button></a>
          <a href="fxpress"><button style="margin-top: 5px;" type="button" class="btn btn-info" ><i class="fa fa-info"> </i> Click for more information on FXPRESS features</button></a>
          <hr>
          <p class="text-primary"><strong>Features:</strong></p>
              <p class="text-primary"><i class="fa fa-star" style="color: #3c8dbc;"></i> Live Interbank Exchange Rates</p>
              <p class="text-primary"><i class="fa fa-star" style="color: #3c8dbc;"></i> Cash Tom Spot Rates</p>
              <p class="text-primary"><i class="fa fa-star" style="color: #3c8dbc;"></i> Forward Rates</p>
              <p class="text-primary"><i class="fa fa-star" style="color: #3c8dbc;"></i> Currency Forecast</p>
              <p class="text-primary"><i class="fa fa-star" style="color: #3c8dbc;"></i> Historical Rates</p>
              <p class="text-primary"><i class="fa fa-star" style="color: #3c8dbc;"></i> Forward Contract Management</p>
        </div>  
        <?php 
        }
        ?>
	    
      </div>
            
    </div><!--/Right Column Progress --> 
    
    
    
                
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

 <script src="bower_components/jquery-ui/jquery-ui.js"></script>
 <script src="bower_components/datatables.net-bs/js/jquery.dataTables.min.js"></script>
 
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
 
    <script type="text/javascript" src="plugins/daterangepicker/daterangepicker.min.js"></script>
    
    <script>
    //'aaSorting': [[6, 'asc']],
    
    $(document).on('keydown', 'input[pattern]', function(e){
        var input = $(this);
        var oldVal = input.val();
        var regex = new RegExp(input.attr('pattern'), 'g');

        setTimeout(function(){
            var newVal = input.val();
            if(!regex.test(newVal)){
                input.val(oldVal); 
            }
        }, 0);
    });

    $(document).ready(function() {
        var nn = 1;
        $('#fwdContractTableAll').DataTable( {
          'columnDefs': [{ 'orderable': false, 'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] }], 
          
          "fnRowCallback" : function(nRow, aData, iDisplayIndex){
            $("td:first", nRow).html(iDisplayIndex +1);
            return nRow;
          },
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            
            // Update footer
            $( api.column( 8 ).footer() ).html(
                pageTotal.toFixed(2)
            );
   
            document.getElementById('gtAmount2').innerHTML = total.toFixed(2);
        }
        });
        
        $('#fwdContractTable').DataTable( {
          'columnDefs': [{ 'orderable': false, 'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] }], 
          
          "fnRowCallback" : function(nRow, aData, iDisplayIndex){
            $("td:first", nRow).html(iDisplayIndex +1);
            return nRow;
          },
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            // Total over all pages
            totalPL = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotalPL = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );    
 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                pageTotal.toFixed(2)
            );
            
            $( api.column( 9 ).footer() ).html(
                pageTotalPL.toFixed(2) 
            );
            
            
            document.getElementById('gtAmount').innerHTML = total.toFixed(2);
            document.getElementById('gtProfitLoss').innerHTML = totalPL.toFixed(2);
            
            if(totalPL.toFixed(2) >= 0)
              document.getElementById('viewProfLoss').innerHTML = "Profit: "+totalPL.toFixed(2);
            else  
              document.getElementById('viewProfLoss').innerHTML = "Loss: "+totalPL.toFixed(2);    
        },
        initComplete: function () {
            
            this.api().columns().every( function () {
                  
                 
                var column = this;
               if(nn == 3 || nn == 5 || nn == 7 || nn == 13){
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
  
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
              }
              nn++;
            } );
            
        }
        });
    });
    //'Profit/Loss: '+pageTotal +' ('+ total +' Total )'  

    function deleteRow(rid){
      var result = confirm("Do you really want to delete this entry?");
      if (result) {
        $.post('delFwdContract', {
		  rowid: rid 
		}, function(response) {
             location.reload(true);
             alert(response);
		});
      }
    }
    
    function updateUtilized(rid, u){
        $.post('updateFwdContract', {
		  rowid: rid,
		  utilized: u
		}, function(response) {
             location.reload(true);
             alert(response);
		});
    }
    
    if (localStorage.getItem("preVal") != null) { 
        var actval = localStorage.getItem("preVal"); 
	if(actval != "2"){
          document.getElementById("d-"+actval).style.display = "block"; //show 
	  document.getElementById("t-"+actval).className += " active"; //nav active
          document.getElementById("d-2").style.display = "none"; //show 
	  document.getElementById("t-2").className = document.getElementById("t-2").className.replace(" active", ""); //hide active class
	}
    }else{ 
        localStorage.setItem("preVal", "2"); 
       // document.getElementById("d-"+actval).style.display = "block"; //show dashboard
       // document.getElementById("t-"+actval).className += " active"; //dashboard nav active
    }	    

    function onNavClick(val){
      var pVal = localStorage.getItem("preVal");

      if(pVal != val){
        localStorage.setItem("preVal", val);
	document.getElementById("d-"+pVal).style.display = "none"; //show dashboard
	document.getElementById("t-"+pVal).className = document.getElementById("t-"+pVal).className.replace(" active", ""); //hide active class

        document.getElementById("d-"+val).style.display = "block"; //show new section
        document.getElementById("t-"+val).className += " active"; //new nav active
      }
    }
    
    
    $(function() {
     $("#ffdate").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy'
     });
     
     $("#ftodate").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy'
     });
     
     $("#fbookdate").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy'
     });
     
     $("#fddfrom").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy'
     });
     
     $("#fddto").datepicker({
         changeYear: true,
         changeMonth:true,
         dateFormat: 'dd-mm-yy'
     });
     
    });

    </script>  

</html>
