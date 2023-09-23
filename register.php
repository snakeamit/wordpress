<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require('vendor/autoload.php');
include_once('lib/database.php');
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer;
// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Host = 'mail.ibrlive.com';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'no-reply@ibrlive.com';       // SMTP username 
$mail->Password = 'Bruno@0346';         // SMTP password 
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 465;

$error = "";
$success = "";
function preVal($str)
{
  return trim($str);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $error = "";
  $success = "";
  $noMsg = "";
  $errors = [];

  if (strcmp($_POST['captchaReg'], $_SESSION['codeReg']) == 0)
    $noMsg = "";
  else
    $error = "Invalid captcha.";

  //Create connection
  $conn = OpenCon();

  // function sendSmsOtp($userphone, $otp)
  // {
  //   //Initialize cURL.
  //   //$ch = curl_init();
  //   $message = "Dear User,
  // Your OTP for registration to IBRLive portal is  $otp . Please do not share this OTP with anyone. IBRLIV";
  //   $postParameter = array(
  //     'username' => 'IBRLIVEIND',
  //     'password' => 'IBRLIVEIND',
  //     'drout'    => 3,
  //     'senderid'  => 'IBRLIV',
  //     'intity_id'  => 1201160750049721812,
  //     'template_id'  => 1207167575509144057,
  //     'numbers' => $userphone,
  //     'language'  => 'en',
  //     'message'  => $message
  //   );

  //   $ch = curl_init();

  //   $url = "http://dlt.fastsmsindia.com/messages/sendSmsApi";
  //   $dataArray = ['page' => 2];

  //   $data = http_build_query($postParameter);

  //   $getUrl = $url . "?" . $data;

  //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  //   curl_setopt($ch, CURLOPT_URL, $getUrl);
  //   curl_setopt($ch, CURLOPT_TIMEOUT, 80);

  //   $response = curl_exec($ch);

  //   print_r($response);
  //   curl_close($ch);
  // }

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $nameuser = preVal($_POST['nameuser']);
  $emailuser = preVal($_POST['emailuser']);
  $userphone = preVal($_POST['phoneuser']);
  $passuser = preVal($_POST['passworduser']);
  $repassword = preVal($_POST['repassworduser']);
  $emailotp = preVal($_POST['emailotp']);
  $interest = "Importer-Exporter";

  if (empty($nameuser))
    $errors['username'] = "Name cannot be blank";

  if ($emailuser) {
    // validate email
    $email = filter_var($emailuser, FILTER_VALIDATE_EMAIL);
    if ($email === false) {
      $errors['email'] = 'Email is not valid';
    }
  } else {
    $errors['email'] = 'Email can not be blank';
  }

  if (!empty($userphone)) {
    if (!preg_match('/^[0-9]{10}+$/', $userphone)) {
      $errors['userphone'] = "Phone number not valid";
    }
  } else {
    $errors['userphone'] = "Phone cannot be blank";
  }

  $pattern  = "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{7,}$/";
  if (!empty($passuser)) {
    if (preg_match($pattern, $passuser) === 0) {
      $errors['passuser'] =  "Password is invalid";
    }
  } else {
    $errors['passuser'] =  "Password can not be blank";
  }

  if (!empty($repassword)) {
    if (preg_match($pattern, $repassword) === 0) {
      $errors['repassuser'] =  "Password is invalid";
    }
  } else {
    $errors['repassuser'] =  "Password can not be blank";
  }

  if (strcmp($passuser, $repassword) !== 0)
    $errors['repassuser'] = "Passwords do not match.";

  // if($emailuser == "" || $emailuser == "0" || $emailuser == "AND 1==1--" || $emailuser == "-1 OR 1=1" || $emailuser == "-1 OR 1=1--"){
  //   $error = "This is not allowed"; 
  // }   

  $email_otp = mt_rand(100000, 999999);

  $sql = "SELECT id FROM customers WHERE email='$emailuser'";
  $result = $conn->query($sql);
  $userData = $result->fetch_assoc();

  $sql = "SELECT otp FROM otpdata WHERE email='$emailuser' and phone = '$userphone' ORDER BY id DESC limit 1";
  $otpdata = $conn->query($sql);
  $otpvalue = $otpdata->fetch_assoc();
  // print_r(empty($otpvalue));
  // echo count($otpvalue).'--------------';
  if ($otpvalue == null && $otpvalue['otp'] != $emailotp) {
    $error = "Please enter correct OTP or use send otp button to regenerate";
  }

  // echo $error;
  // die;

  if ($error == "" && count($errors) === 0) {
    #$result = mysqli_query($conn, "SELECT id FROM customers where email = ORDER BY id DESC LIMIT 1");
    #$row = mysqli_fetch_array($result);
    #$idmax=$row['id'];

    #$idmax = $idmax + 1;
    //Generating 6 Digit Random OTP


    $passuser = password_hash($passuser, PASSWORD_DEFAULT);
    $dateToday = date("Y-m-d");
    $member = "Normal";
    $emailverifiy = 0;

    $sql = "INSERT INTO customers (name, email, phone, password, created, member, email_otp, interest,address,modified,payMethod,topic, is_verify, otp,passcookie) VALUES ('$nameuser', '$emailuser', '$userphone', '$passuser', '$dateToday', '$member', '$emailotp','$interest','', '0000-00-00 00:00:00', '', '', $emailverifiy, '8729', '')";

    if ($conn->query($sql) === TRUE) {
      $success = "User added successfully!";

      $ccid = $conn->insert_id;

      if ($interest == "Importer-Exporter") {
        $tp = 0;
        $st = 0;
        $sql2 = "INSERT INTO orders (customer_id, total_price, created, modified, status) VALUES ('$ccid', '$tp', '$dateToday', '$dateToday', '$st')";

        if ($conn->query($sql2) == TRUE) {
          $coid = $conn->insert_id;
          $pid = 7;
          $qty = 1;
          $sql3 = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$coid', '$pid', '$qty')";

          $validity = 10;
          $expiredate = date('Y-m-d', strtotime("+10 day"));

          if ($conn->query($sql3) == TRUE) {
            $sts2 = "AVAILABLE";
            $sql4 = "INSERT INTO subscription (customer_id, order_id, product_id, paid_on, expire_on, status) VALUES ('$ccid', '$coid', '$pid', '$dateToday', '$expiredate', '$sts2')";
            if ($conn->query($sql4) == TRUE) {
            }
          }
        }
      }


      $conn->close();
      header('Location: register-success.php');
      exit();
    } else {
      #$error = "Error: Email already exist!";
      $error = $conn->error;
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
  <?php include_once('include/head.php'); ?>

  <style>
    .formerror {
      display: none;
      margin-left: 10px;
    }

    .error_show {
      color: red;
      margin-left: 10px;
    }



    #pswd_info {
      background: #dfdfdf none repeat scroll 0 0;
      color: #fff;
      left: 20px;
      /* position: absolute; */
      top: 280px;
      margin-top: 270px;
    }

    #pswd_info h4 {
      background: #0f3c9a none repeat scroll 0 0;
      display: block;
      font-size: 14px;
      letter-spacing: 0;
      padding: 17px 0;
      text-align: center;
      text-transform: uppercase;
      color: #fff;
    }

    #pswd_info ul {
      list-style: outside none none;
    }

    #pswd_info ul li {
      padding: 10px 45px;
    }



    .valid {
      background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/vq43s2wib/valid.png") no-repeat scroll 2px 6px;
      color: green;
      line-height: 21px;
      padding-left: 22px;
    }

    .invalid {
      background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/olmaj1p8z/invalid.png") no-repeat scroll 2px 6px;
      color: red;
      line-height: 21px;
      padding-left: 22px;
    }


    #pswd_info::before {
      background: #dfdfdf none repeat scroll 0 0;
      content: "";
      height: 25px;
      left: -13px;
      margin-top: -12.5px;
      position: absolute;
      top: 50%;
      transform: rotate(45deg);
      width: 25px;
    }

    #pswd_info {
      display: none;
    }

    label {
      font-weight: bold;
      display: inline-block;
      margin-top: 20px;
    }

    label span {
      font-size: 1rem;
    }

    label.error {
      color: red;
      display: block;
      margin-top: 5px;
    }

    input.error {
      border: 1px dashed red;
      font-weight: 300;
      color: red;
    }

    .has-feedback label~.form-control-feedback {
      top: 45px;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }

    function openNewWebsite(obj) {
      //alert(obj.value);
      if (obj.value == "Student-Banker") {
        window.location = "https://ibrlive.estudium.org/signup";
      }

    }
  </script>

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-3HB1M04NFG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-3HB1M04NFG');
  </script>

</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body>

  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <?php include_once('include/top-menu.php'); ?>

    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">New User &ndash; Registration</h4>
      </div>
    </div>
  </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <section class="content">
        <div class="row">
          <div class="col-md-2">
          </div>
          <div class="col-md-6">
            <div class="box box-primary">

              <div class="box-body">
                  <!--p class="login-box-msg"><button class="btn btn-warning"><a style="color: white;" href="https://ibrlive.estudium.org/signup">Students/Bankers Register at ibrlive.estudium.org <i class="fa fa-angle-double-right"></i></a></button></p>
                 <p class="login-box-msg">Importer/Exporter &ndash; Register below <i class="fa fa-angle-double-down"></i></p-->

                  <form action="" method="post" id="register" class="form">
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
                      <input type="text" class="form-control" name="nameuser" id="nameuser" required placeholder="Full name" value="<?php if (isset($_POST['nameuser'])) echo $_POST['nameuser']; ?>" />
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      <span class="<?php echo isset($errors['username']) ? 'error_show' : ''  ?>"><?php echo $errors['username'] ?? '' ?></span>
                    </div>
                    <div class="form-group has-feedback">
                      <label for="emailuser">Your Email &#42;</label>
                      <input type="email" required class="form-control" name="emailuser" id="emailuser" placeholder="Email" value="<?php if (isset($_POST['emailuser'])) echo $_POST['emailuser']; ?>" />
                      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      <span id="availability" class="<?php echo isset($errors['email']) ? 'error_show' : ''  ?>"><?php echo $errors['email'] ?? '' ?></span>
                    </div>
                    <div class="form-group has-feedback">
                      <label for="phoneuser">Your Phone &#42;</label>
                      <input maxlength="10" minlength="10" onKeyPress="return isNumberKey(event);" required type="text" id="phoneuser" class="form-control" name="phoneuser" placeholder="Phone" value="<?php if (isset($_POST['phoneuser'])) echo $_POST['phoneuser']; ?>" />
                      <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                      <span id="phoneavail" class="<?php echo isset($errors['userphone']) ? 'error_show' : ''  ?>"><?php echo $errors['userphone'] ?? '' ?></span>
                    </div>
                    <div class="form-group has-feedback">
                      <label for="passworduser">Password &#42; </label>
                      <input maxlength="15" required minlength="5" type="password" class="form-control" name="passworduser" id="passworduser" placeholder="Password (Min 5 and Max 15 chars)" />
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      <span class="<?php echo isset($errors['passuser']) ? 'error_show' : ''  ?>"><?php echo $errors['passuser'] ?? '' ?></span>
                    </div>
                    <div class="form-group has-feedback">
                      <label for="repassworduser">Re-type Password &#42;</label>
                      <input maxlength="15" required minlength="5" type="password" class="form-control" name="repassworduser" placeholder="Retype password" />
                      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                      <span class="<?php echo isset($errors['repassuser']) ? 'error_show' : ''  ?>"><?php echo $errors['repassuser'] ?? '' ?></span>
                    </div>
                    <div class="form-group has-feedback">
                      <div class="form-group mb-2">
                        <label for="passworduser">OTP &#42; </label>
                        <input type="password" class="form-control" name="emailotp" id="emailotp" placeholder="Enter OTP" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <input id="otphide" name="otphide" type="hidden" value="" />
                      </div>
                      <div class="form-group mb-2">
                        <input type="button" value="Send OTP" class="emailotp" id="send_otp">
                      </div>
                    </div>

                    <div class="form-group">
                      <img src="captchaReg.php" />
                      <br />
                      Write the code below:
                      <br />
                      <input type="text" class="form-control"  name="captchaReg" required />
                    </div>

                    <div class="row">
                      <div class="col-xs-8">
                        <div class="checkbox icheck">
                          <label>
                            <?php
                            if ($error == "") {
                              if ($success == "") {
                              } else {
                                echo "<p style=\"color: green; font-size: 14px; text-align: center;\"><b>$success</b></p>";
                              }
                            } else {
                              echo "<p style=\"color: red; font-size: 14px; text-align: center;\"><b>$error</b></p>";
                            }
                            ?>
                          </label>
                        </div>
                      </div><!-- /.col -->
                      <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="contact_submit">Register</button>
                      </div><!-- /.col -->
                    </div>
                  </form>

                  <a href="login.php" class="text-center">Already a member? Login Here</a>
              </div><!-- /.box -->
            </div>
          </div><!-- /.col -->

          <div class="col-md-4">
            <div id="pswd_info">
              <h4>Password must be requirements</h4>
              <ul>
                <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                <li id="number" class="invalid">At least <strong>one number</strong></li>
                <li id="length" class="invalid">Be at least <strong>5 characters and Max 15</strong></li>
                <li id="space" class="invalid">Be<strong> use [!,@,#,$,%,^,&,*,-]</strong></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>


  <?php include_once("include/footer.php"); ?>
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
      $("#register").validate();
    });
    $('#passworduser').keyup(function() {
      var pswd = $(this).val();

      //validate the length
      if (pswd.length < 5) {
        $('#length').removeClass('valid').addClass('invalid');
      } else {
        $('#length').removeClass('invalid').addClass('valid');
      }

      //validate letter
      if (pswd.match(/[A-z]/)) {
        $('#letter').removeClass('invalid').addClass('valid');
      } else {
        $('#letter').removeClass('valid').addClass('invalid');
      }

      //validate capital letter
      if (pswd.match(/[A-Z]/)) {
        $('#capital').removeClass('invalid').addClass('valid');
      } else {
        $('#capital').removeClass('valid').addClass('invalid');
      }

      //validate number
      if (pswd.match(/\d/)) {
        $('#number').removeClass('invalid').addClass('valid');
      } else {
        $('#number').removeClass('valid').addClass('invalid');
      }

      //validate space
      if (pswd.match(/[^a-zA-Z0-9\-\/]/)) {
        $('#space').removeClass('invalid').addClass('valid');
      } else {
        $('#space').removeClass('valid').addClass('invalid');
      }

    }).focus(function() {
      $('#pswd_info').show();
    }).blur(function() {
      $('#pswd_info').hide();
    });

    $('#emailuser').blur(function() {

      var email = $(this).val();

      $.ajax({
        url: 'check_email',
        method: "POST",
        data: {
          email: email
        },
        success: function(data) {
          if (data != '0') {
            $('#availability').html('<span class="text-danger">User email already exist</span>');
            $('#contact_submit').attr("disabled", true);
            $('#send_otp').attr("disabled", true);

          } else {
            $('#availability').html('<span class="text-success">User email Available</span>');
            $('#contact_submit').attr("disabled", false);
            $('#send_otp').attr("disabled", false);
          }
        }
      })

    });

    $('#phoneuser').blur(function() {

      var phone = $(this).val();

      $.ajax({
        url: 'check_phone',
        method: "POST",
        data: {
          phone: phone
        },
        success: function(data) {
          if (data != '0') {
            $('#phoneavail').html('<span class="text-danger">User phone already exist</span>');
            $('#contact_submit').attr("disabled", true);
            $('#send_otp').attr("disabled", true);
          } else {
            $('#phoneavail').html('<span class="text-success">User phone Available</span>');
            $('#contact_submit').attr("disabled", false);
            $('#send_otp').attr("disabled", false);
          }
        }
      })

    });

    // Send otp 
    $('#register').on('click', '.emailotp', function() {
      //var userDataTable  = $('#allblogs').DataTable();
      // AJAX request
      var email = $('#emailuser').val();
      var phone = $('#phoneuser').val();
      if (email == '') {
        alert('Email not provided.')
        exit();
      }
      if (phone == '') {
        alert('Phone not provided.')
        exit();
      }
      $.ajax({
        url: 'email-otp',
        type: 'POST',
        data: {
          email_id: email,
          phone: phone
        },
        success: function(response) {
          if (response == 1) {
            alert("OTP sent to entered email id and phone");
          } else {
            alert("Invalid input.");
          }
        }
      });

    });
  </script>
</body>

</html>
