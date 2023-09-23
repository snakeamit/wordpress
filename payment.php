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
  $custid = "";
  $invoiceid = "";

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
        $member = $row['member'];
        $phone = $row['phone'];    	
        $custid = $row['id'];
      }
    }else{
      $error = "Invalid Email or Password";
    }    

    $sql2 = "SELECT MAX(invoice_id) As invid FROM invoice";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {          	
        $invoiceid = $row['invid']+1;
      }
    }else{
      $error = "Invalid Email or Password";
    } 

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
}else{
  $name = "Guest";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Checkout | IBR Live</title>
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
  
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div id="coverScreen" class="LockOn"></div>
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
                  <i class="fa fa-credit-card"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Pay your order </p>
                </div>

              </div>
            </div><!-- /.col -->

          <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Confirm and Pay</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">           

                  
                </div>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Order Id</th>
                  <td><?php echo $invoiceid ?></td>
                </tr>
                <tr>  
                  <th>Customer Id</th>
                  <td><?php echo $custid ?></td>
                </tr>
                <tr>
                  <th>Customer Name</th>
                  <td><?php echo $name ?></td>
                </tr> 
                <tr>
                  <th>Amount</th>
                  <td></td>
                </tr>
                <tr>
                  <th><button class="btn btn-success">Pay Now</button></th>
                  <td></td>
                </tr>                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
