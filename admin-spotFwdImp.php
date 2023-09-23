<?php
  if(isset($_POST['spotPrem-1'])) {
    $servername = "localhost";
    $username = "ibrlive";
    $password = "tubelight";
    $dbname = "ibrMock";
    $succ = "";
    $err = "";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      $err = "Error! Try again Later!";
    }else{
      $succ = "Connection established";
    } 

    for ($i = 1; $i <= 12; $i++) {
      $fromDate = strval($_POST['spotFromDt-'.$i]);
      $toDate = strval($_POST['spotToDt-'.$i]);
      $days = $_POST['spotDay-'.$i];
      $premium = $_POST['spotPrem-'.$i];
    
$sql="UPDATE spotForwardImp SET fromDate='$fromDate', toDate='$toDate', days='$days', premium='$premium' WHERE id=$i";
    
      if ($conn->query($sql) === TRUE) {
        $succ = "Record updated successfully";
      } else {
        $err = "Error updating record: " . $conn->error;
      }
    }
    
    $conn->close();
  }

  $dateToday = new DateTime('today');
  $tday = new DateTime('today'); 
  
  $dt = new DateTime('today + 3 day'); 

  function addMonth($day, $dt, $mt) {
    $dt->modify('first day of +1 month');
    $dt->modify('+' . (min($day, $dt->format('t')) - $mt) . ' days');
    return $dt->format('d-m-Y');  
  }      

  function addDay($dt) {
    $dt = new DateTime($dt);
    $dt->modify('+1 day');
    return $dt->format('d-m-Y');  
  }
  
  function add3Days($dt) {
    $dt->modify('+3 days');
    return $dt->format('d-m-Y');  
  }
  
  function removeDay($dt) {
    $dt = new DateTime($dt);
    $dt->modify('-1 day');
    return $dt->format('d-m-Y');  
  }  
  
  $arrDay = array();
  
  $arrDay[0] = add3Days($dateToday);

  for($k=0; $k<23; $k=$k+2){
    $temp = addMonth($arrDay[$k], $dt, 1);
    $arrDay[$k+1] = removeDay($temp);
    $arrDay[$k+2] = $temp;  
  }

  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7"){

    }else{
      header("Location: profile.php");
      exit();
    }
  }else{
    header("Location: login.php");
    exit();
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

  if(!isset($_SESSION['member'])){
    if($error == ""){
    $sql = "SELECT id, month, fromDate, toDate, days, premium FROM spotForward";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $error = "";    	
      }
    }else{
      $error = "Error!";
    } 
    }
  }else{
    $member=$_SESSION['member'];
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Spot - Forward Import | IBR Live</title>
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
    .no-border {
        border-width:0px; border:none
    }
  </style>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">


  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header" align=center>
              
              <i class="fa fa-user"></i>
              <p class="box-title" style="font-size: 22px;"><b>Admin - Forward Rates - Import (Ask)! </p>
              
            </div>
            <div class="box-body pad table-responsive">
                  
            </div><!-- /.box -->
          </div>
        </div><!-- /.col -->        
        <!-- /.col -->               

        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
                
              <h3 class="box-title"><b>Spot Rate and Forward Rates - Import (Ask)</b></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">       <button class="btn btn-primary"><a style="color: white;" href="profile">Back To Profile</a></button>           
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Date Today</th>
                  <th>Forward Start Date</th> 
		        </tr>
                <tr>
                  <td><input readonly name="dateToday" value=<?php echo $tday->format('d-m-Y');?> style="color:blue; font-size: 16px; border-width:0px; border:none;"></td>        
                  <td><input readonly name="dateFwd" value=<?php echo $arrDay[0] ;?> style="color:blue; font-size: 16px;border-width:0px; border:none;"></td>        
                </tr>    
                <tr>
                  <td colspan=2></td>    
                </tr>    
              </table>
            </div>
            
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Month</th>
                  <th>From Date</th>
                  <th>To Date</th>      
		          <th>Days</th>				  
		          <th>Premium</th>
                </tr>
                
                <?php    
                //Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $custId= $_SESSION['sessCustomerID'];
                $query = "SELECT id, month, fromDate, toDate, days, premium FROM spotForwardImp";
                $result2 = $conn->query($query);
	
                $pname = "";
                $m=0;
                
                ?>
                <form action="" method="post"> 
                <?php
                $d=0;
                while($row2 = $result2->fetch_assoc()){ 
                  $end = new DateTime($arrDay[$m+1]);
                  $start = new DateTime($arrDay[$m]);
                  
                  $dif = $end->diff($start); 
                  $dif = intval($dif->d)+1;
                  
                  $d++;
                  echo "<tr>
                  <td><input id='spotMonth-". $d."' type='text' name='spotMonth-". $d."' readonly class='no-border' value=". $row2['month'] . "></td>
                  <td><input id='spotFromDt-". $d."' type='text' name='spotFromDt-". $d."' readonly class='no-border' value=". $arrDay[$m] . "></td>
                  <td><input id='spotToDt-". $d."' type='text' name='spotToDt-". $d."' readonly class='no-border' value=". $arrDay[$m+1] . "></td>
                  <td><input id='spotDay-". $d."' type='text' name='spotDay-". $d."' readonly class='no-border' value=". $dif . "></td>
                  <td>&#8377; <input id='spotPrem-". $d."' value=". $row2['premium'] ." name='spotPrem-". $d."' type='text' class='numbersonly' style='font-size: 16px; color: blue'></td>
                  </tr>";  
                  
                  $m = $m + 2;
                }
                ?>
                
                <tr>
                  <td colspan="4"></td>
                  <td colspan=3><button name="submit" value="Submit" id="submit_form" class="btn btn-warning"><i class="fa fa-save fa-lg" style=""> Save All </i></button></td>    
                </tr> 
                
                </form>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div> 
      </div>

    </section>



  <?php include_once("include/footer.php"); ?>
  </div>
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