<?php
// ini_set('display_errors', 1); 
// error_reporting(E_ALL);
include_once('lib/database.php');
if(session_id()=='' || !isset($_SESSION)){
  session_start();
}

if(!$_GET['email'] && !$_GET['phone']) {
    header('Location: register.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  //Create connection
  $conn = OpenCon();

  $email = trim($_GET['email']);
  $phone = trim($_GET['phone']);
  $otp = $_POST['emailotp'];
  $sql = "SELECT email_otp, is_verify, name FROM customers WHERE email=0 AND phone='$phone'";
  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_assoc();

  if($otp === $row['email_otp']) {
    $sql="UPDATE customers SET is_verify=true, email_otp=null WHERE email='$email' ";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: register-success.php');
    } else {
        //print_r($conn->error);
        echo "<script>alert('There is some issue please try after some time')</script>" ;
    }  
  }

  $conn->close();
}
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register | IBR Live</title>
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
  <style>
    .formerror {
      display: none;
      margin-left: 10px;
    }
    .error_show{
      color: red;
      margin-left: 10px;
    }
  </style>
   <style>
    label {
  width: 300px;
  font-weight: bold;
  display: inline-block;
  margin-top: 20px;
}

label span {
  font-size: 1rem;
}

label.error {
    color: red;
    font-size: 1.3rem;
    display: block;
    margin-top: 5px;
}

input.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
.has-feedback label~.form-control-feedback {
  top: 0px;
}
  </style>

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
    
    function openNewWebsite(obj)
    {
      //alert(obj.value);
      if(obj.value == "Student-Banker"){
        window.location = "https://ibrlive.estudium.org/signup";
      }
      
    }
  </script> 
  
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-123754068-1');
    </script>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content">
     <div class="row">
       <div class="col-md-4">
       </div>
       <div class="col-md-4">
         <div class="box box-primary">
           <div class="box-header" align=center>
             <i class="fa fa-envelope"></i>
               <p class="box-title" style="font-size: 22px;"><b>New User &ndash; Registration </p>
           </div>
           <div class="box-body pad table-responsive">
             <div class="">
               <div class="register-box-body">
                 <!--p class="login-box-msg"><button class="btn btn-warning"><a style="color: white;" href="https://ibrlive.estudium.org/signup">Students/Bankers Register at ibrlive.estudium.org <i class="fa fa-angle-double-right"></i></a></button></p>
                 <p class="login-box-msg">Importer/Exporter &ndash; Register below <i class="fa fa-angle-double-down"></i></p-->
                 
                  <form action="" method="post" id="verify">

                  <div class="form-group has-feedback">
                      <div class="form-group mb-2">
                        <input type="password" class="form-control" name="emailotp" placeholder="Enter OTP" value="" required/>
                        <span class="<?php echo isset($errors['emailotp']) ? 'error_show' : ''  ?>"><?php echo $errors['emailotp'] ?? '' ?></span>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                        <input type="button" value="Resend OTP" class="emailotp">
                      </div>
                  </div>

                  <div class="row">
                   <div class="col-xs-4">
                     <button type="submit" class="btn btn-primary btn-block btn-flat" id="contact_submit">Submit</button>
                   </div><!-- /.col -->
                 </div>
                 </form>   

                 <a href="login.php" class="text-center">Already a member? Login Here</a>
                 </div><!-- /.form-box -->
                </div><!-- /.register-box -->
                </div><!-- /.box -->
              </div>
            </div><!-- /.col -->

            <div class="col-md-4">
              
            </div>
     </div>    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
        $(document).ready(function() {
            $("#verify").validate();
         });
            // Delete record
            $('#verify').on('click','.emailotp',function(){
                //var userDataTable  = $('#allblogs').DataTable();
                    // AJAX request
                    $.ajax({
                    url: 'email-otp',
                    type: 'POST',
                    data: {email_id:"<?php echo $_GET['email'];?>", phone:<?php echo $_GET['phone'];?>},
                    success: function(response){
                        if(response == 1){
                            alert("OTP sent to given email id and phone");
                        }else{
                            alert("Invalid input.");
                        }
                    }
                    });

            });
</script>

</body>
</html>  