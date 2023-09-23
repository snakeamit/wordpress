<?php
if(session_id()=='' || !isset($_SESSION)){
  session_start();
}
$your_email = 'no-reply@ibrlive.com';

$error = "";
$success = "";



if(isset($_POST['register'])){
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  $error = ""; $success = "";
  $noMsg="";
  
  if(strcmp($_POST['captchaReg'],$_SESSION['codeReg']) == 0)
    $noMsg = "";
  else
    $error = "Invalid captcha.";
    
  //Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }   

  if(strcmp($_POST['passworduser'],$_POST['repassworduser']) == 0)
    $noMsg = "";
  else
    $error = "Error: Passwords do not match.";

  $nameuser = $_POST['nameuser'];
  $emailuser = $_POST['emailuser'];
  $phoneuser = $_POST['phoneuser'];
  $passuser = $_POST['passworduser'];
  $validateotp = $_POST['validateotp'];
  $interest = "Importer-Exporter";
    
  if($nameuser == "")
    $error = "Name cannot be blank";

  if($emailuser == "")
    $error = "Email cannot be blank";
    
  if($emailuser == "" || $emailuser == "0" || $emailuser == "AND 1==1--" || $emailuser == "-1 OR 1=1" || $emailuser == "-1 OR 1=1--"){
    $error = "This is not allowed"; 
  }   
  
  if($validateotp == ""){
    $error = "OTP cannot be blank";
  }
  
    

  if($error == ""){
    $query=mysqli_query($conn,"SELECT otp FROM emailvalidate WHERE email='$visitor_email'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
        if($num['otp'] == $otp){
          $passuser = password_hash($passuser, PASSWORD_DEFAULT);
          $dateToday = date("Y-m-d"); 
          $member = "Normal";
          
          $sql = "INSERT INTO customers (name, email, phone, password, created, member, interest,address,modified,payMethod,topic,otp,passcookie) VALUES ('$nameuser', '$emailuser', '$phoneuser', '$passuser', '$dateToday', '$member', '$interest','','0000-00-00 00:00:00','','','8729','')";
          if ($conn->query($sql) === TRUE) {
            $success = "User added successfully!";
            
            $ccid=$conn->insert_id;
            
            if($interest == "Importer-Exporter"){
              $tp = 0;  $st=0;
              $sql2 = "INSERT INTO orders (customer_id, total_price, created, modified, status) VALUES ('$ccid', '$tp', '$dateToday', '$dateToday', '$st')";  
              
              if($conn->query($sql2) == TRUE){
                  $coid=$conn->insert_id;
                  $pid = 7; $qty = 1;
                  $sql3 = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$coid', '$pid', '$qty')";
                  
                  $validity = 10;
                  $expiredate = date('Y-m-d', strtotime("+10 day"));
                                    
                  if($conn->query($sql3) == TRUE){
                      $sts2 = "AVAILABLE"; 
                      $sql4 = "INSERT INTO subscription (customer_id, order_id, product_id, paid_on, expire_on, status) VALUES ('$ccid', '$coid', '$pid', '$dateToday', '$expiredate', '$sts2')";
                      if($conn->query($sql4) == TRUE){
                      }
                  }    
                  
              }
            }
            
            
            $conn->close();
            header('Location: register-success.php');
            exit();      
          } else {
            #$error = "Error: Email already exist!";
            $error = $conn -> error;
      
          } 
        }
        else{
          $error = "OTP did not match";
        }


  }
  
    #$result = mysqli_query($conn, "SELECT * FROM customers ORDER BY id DESC LIMIT 1");
    #$row = mysqli_fetch_array($result);
    #$idmax=$row['id'];

    #$idmax = $idmax + 1;
    
    
   
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
               <p class="box-title" style="font-size: 22px;"><b>New User &ndash; Registeration </p>
           </div>
           <div class="box-body pad table-responsive">
             <div class="">
               <div class="register-box-body">
                 <!--p class="login-box-msg"><button class="btn btn-warning"><a style="color: white;" href="https://ibrlive.estudium.org/signup">Students/Bankers Register at ibrlive.estudium.org <i class="fa fa-angle-double-right"></i></a></button></p>
                 <p class="login-box-msg">Importer/Exporter &ndash; Register below <i class="fa fa-angle-double-down"></i></p-->
                 
                  <form action="" method="post">
                  <!--div class="form-group has-feedback">
                    <label for="interest">Choose your profession &#42;</label><br/>
                    <select onchange="openNewWebsite(this);" class="form-control" required name="interest" id="interest">
                        <option value="">Select Profession</option>
                        <option value="Importer-Exporter">Importer/Exporter</option>
                        <option value="Student-Banker">Student/Banker</option>
                    </select>
                    
                  </div-->     
                  <!--input name="interest" id="interest" value="Importer-Exporter" hidden-->
                  <div class="form-group has-feedback">
                    <label for="nameuser">Your Name &#42;</label>  
                    <input maxlength="75" required type="text" class="form-control" name="nameuser" placeholder="Full name"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="emailuser">Your Email &#42;</label>
                    <input  maxlength="100" id="email_id" required type="text" class="form-control" name="emailuser" placeholder="Email"/>
                    <label style="color:red" id='emailmsg'></label>
                    <button id="otpbutton" type="button" onclick="sendotp()" style="display: none;" class="btn btn-danger"  class="btn-upper btn btn-info checkout-page-button" >Send Otp</button>
                    
                    
                    <span class="glyphicon glyphicon-envelope form-control-feedback" ></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="phoneuser">Your Phone &#42;</label>  
                    <input maxlength="15" minlength="10" onKeyPress="return isNumberKey(event);" type="text" required class="form-control" name="phoneuser" placeholder="Phone"/>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="passworduser">Password (Min 5 and Max 15 Chars) &#42;</label>   
                    <input maxlength="15" minlength="5" required type="password" class="form-control" name="passworduser" placeholder="Password (Min 5 and Max 8 chars)"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <label for="repassworduser">Re-type Password &#42;</label>  
                    <input maxlength="15" minlength="5" required type="password" class="form-control" name="repassworduser" placeholder="Retype password"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  </div>
                  <div id="validateotpdiv" style="display: none;" class="form-group has-feedback">
                    <label for="repassworduser">Enter OTP from email &#42;</label>  
                    <input  placeholder="enter OTP" required name="validateotp" id="validateotp" type="number" class="form-control" >
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  </div>
                 

                  <div class="form-group">
                    <img src="captchaReg.php" />
                    <br/>
                    Write the code below:
                    <br/>
                    <input required type="text" name="captchaReg" />
                  </div>
                  <div class="row">
                    <div class="col-xs-8">    
                      <div class="checkbox icheck">
                      <label>
                        <?php
                          if($error == ""){
                            if($success == ""){
                            }else{
                              echo "<p style=\"color: green; font-size: 16px; text-align: center;\"><b>$success</b></p>"; 
                            }
                          }else{
                            echo "<p style=\"color: red; font-size: 16px; text-align: center;\"><b>$error</b></p>"; 
                          }
                        ?>
                      </label>
                      </div>                        
                    </div><!-- /.col -->
                   <div class="col-xs-4">
                     <button type="submit" class="btn btn-primary btn-block btn-flat" name="register">Register</button>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
function sendotp(){
    var email_id = $("#email_id").val();
    
    var dataString = 'email_id=' + email_id;
    
  $.ajax({
		 type: "POST",
		 url: "/sendotp", 
		 data: dataString,
     cache: false,
     success: function(html) {
alert(html);
}
   
    });

   

}
</script>



<script>
 var validate_email = function(email){
  var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var is_email_valid = false;
  if(email.match(pattern) != null){
    is_email_valid = true;
  }
  return is_email_valid;
}

$(document).on("keyup", "#email_id", function(event){
  var keypressed = event.which;
  var input_val = $(this).val();
  var is_success = true;
  if(keypressed == 9){
    is_success = validate_email(input_val); 
    if(!is_success){
      $('#emailmsg').text('Enter valid email')
      $(this).focus();

    }
  

  }
});

$(document).on("focusout", "#email_id", function(){
  var input_val = $(this).val();
  var is_success = validate_email(input_val); 
  $('#emailmsg').text('')

  $('#validateotpdiv').attr("style", "display:none")
    $('#otpbutton').attr("style", "display:none")


  if(!is_success){
    $('#emailmsg').text('Enter valid email')

    $('#validateotpdiv').attr("style", "display:none")
    $('#otpbutton').attr("style", "display:none")
    $("#email_id").focus();
  }
  else{
    $('#validateotpdiv').attr("style", "display:block")
    $('#otpbutton').attr("style", "display:block")
    
    
  }
}); 

</script>

</body>
</html>  