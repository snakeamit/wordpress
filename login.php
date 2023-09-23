<?php
include_once('lib/database.php');
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  $allow = $_SESSION['userallow'];
  $useremail = $_SESSION['useremail'];
} else {
  $user = "";
  $allow = "";
  $useremail = "";
}

$error = "";
$success = "";

function random_str(
  int $length = 64,
  string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
  if ($length < 1) {
    throw new \RangeException("Length must be a positive integer");
  }
  $pieces = [];
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
    $pieces[] = $keyspace[random_int(0, $max)];
  }
  return implode('', $pieces);
}

if (isset($_POST['emailuser'])) {
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";

  //Create connection
  $conn = OpenCon();
  //$conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $error = "";
  $success = "";

  $hash = "";
  $allow = "";
  $email = $_POST['emailuser'];
  #$conn->query('SET NAMES utf8');

  #$email = mysql_real_escape_string("\xbf\x27 OR 1=1 /*");
  #$email = $conn->real_escape_string("OR 1=1 /*");

  if ($email == "") {
    exit();
  }

  if ($error == "") {
    $sql = "SELECT id, name, phone, paid, created, validity, amount, password FROM customers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hash = $row['password'];
        $_SESSION['userid'] = $row['id'];
        $_SESSION['sessCustomerID'] = $row['id'];
        $_SESSION['userallow'] = $row['paid'];
        $_SESSION['username'] = $row['name'];
        $_SESSION['useremail'] = $email;
        $_SESSION['userphone'] = $row['phone'];
      }

      date_default_timezone_set('Asia/Kolkata');
      $ldate = date('d-m-Y h:i:s A', time());

      $uip = $_SERVER['REMOTE_ADDR'];

      $sql = "INSERT INTO userlog (userEmail,userip,loginTime,logout,status) VALUES ('$email', '$uip','$ldate','',0)";

      if ($conn->query($sql) === TRUE) {
        $successLog = "User log successfully!";
      }
    } else {
      $error = "Invalid Email or Password";
    }
  }

  $custId = $_SESSION['sessCustomerID'];
  //$dateNow = date();
  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
  $dateNow = $date->format('Y-m-d');

  if ($custId) {
    $sql2 = "SELECT * FROM `subscription` WHERE customer_id='$custId' AND status='AVAILABLE' AND expire_on >= '$dateNow' AND product_id>='1' AND product_id<='3' ORDER BY product_id DESC";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
      $_SESSION['MFEXAM'] = "AVAILABLE";
    } else {
      $_SESSION['MFEXAM'] = "NOTAVAILABLE";
    }

    $sql3 = "SELECT * FROM `subscription` WHERE customer_id='$custId' AND status='AVAILABLE' AND expire_on >= '$dateNow' AND product_id>='4' AND product_id<='6' ORDER BY product_id DESC";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
      $_SESSION['FEEXAM'] = "AVAILABLE";
    } else {
      $_SESSION['FEEXAM'] = "NOTAVAILABLE";
    }

    $sql4 = "SELECT * FROM `subscription` WHERE customer_id='$custId' AND status='AVAILABLE' AND expire_on >= '$dateNow' AND product_id='7' ";
    $result4 = $conn->query($sql4);

    if ($result4->num_rows > 0) {
      $_SESSION['FXPRESS'] = "AVAILABLE";
    } else {
      $_SESSION['FXPRESS'] = "NOTAVAILABLE";
    }

    // For the Subscription validation checking purpose use
    $sql5 = "SELECT * FROM `subscription` WHERE customer_id='$custId' AND status='AVAILABLE' AND expire_on >= '$dateNow' ";
    $result5 = $conn->query($sql5);

    if ($result5->num_rows > 0) {
      $_SESSION['SUBSCRIPTION_CHECKING'] = "AVAILABLE";
    } else {
      $_SESSION['SUBSCRIPTION_CHECKING'] = "NOTAVAILABLE";
    }
  }

  if ($hash == "") {
    $error = "Invalid Email or Password";
  } else {
    $auth = password_verify($_POST['passworduser'], $hash);
    if ($auth == 1) {
      $allow;
      $success = "Authentication successful";

      $randToken = random_str(15);
      $tokenHash = password_hash($randToken, PASSWORD_DEFAULT);

      $sql_i = "update customers set passcookie='$tokenHash' WHERE email='$email' ";
      $res = $conn->query($sql_i);
      if ($res) {
        if (!empty($_POST["remember"])) {
          setcookie("email", "$email", time() + 108000, "/", "", 1);
          setcookie("token", "$randToken", time() + 108000, "/", "", 1);
        } else {
          if (isset($_COOKIE['email'])) {
            setcookie("email", "", time() - 60, "/", "", 1);
            setcookie("token", "", time() - 60, "/", "", 1);
          }
        }
      }

      $conn->close();
      // header('Location: forward-rates.php');
      $subcription_chk = $_SESSION['SUBSCRIPTION_CHECKING'];
      if($subcription_chk === "AVAILABLE"){
        header('Location: forward-rates.php');
      }
      if($subcription_chk === "NOTAVAILABLE"){
        header('Location: forward_rates_new.php');
      }  
      exit();
    } else {
      $user = "";
      $allow = "";
      unset($_SESSION['username']);
      unset($_SESSION['userallow']);
      unset($_SESSION['member']);
      unset($_SESSION['MFEXAM']);
      unset($_SESSION['FEEXAM']);
      unset($_SESSION['FXPRESS']);
      $error = "Authentication Failed";
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
  <title>Login | IBR Live</title>
  <meta name="description" content="IBR-Live Login for existing users">
  <meta name="keywords" content="login, user, ibrlive">

  <?php include_once('include/head.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Login</h4>
      </div>
    </div>
  </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <section class="content">
        <div class="row">
          <div class="col-md-4">
          </div>

          <div class="col-md-4">
            <div class="login-box-body">
              <div class="box-header" align=center>
                <i class="fa fa-envelope"></i>
                <p class="box-title" style="font-size: 22px;"><b>Existing User &ndash; Login Here </p>
              </div>
              <p class="login-box-msg">Sign in to start your session</p>
              <form action="" method="post" id="login_form">
                <div class="form-group has-feedback">
                  <input type="email" class="form-control" name="emailuser" placeholder="Email" required />
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="passworduser" placeholder="Password" required />
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <label for="remember"><input type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE["member_login"])) { ?> checked <?php } ?> class="" />
                    Remember me</label>
                </div>
                <div class="row">
                  <div class="col-xs-8">

                  </div><!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                  </div><!-- /.col -->
                </div>
              </form>
              <?php
              if ($error == "") {
                if ($success == "") {
                } else {
                  echo "<p style=\"color: green; font-size: 16px; text-align: left;\"><b>$success</b></p>";
                }
              } else {
                echo "<p style=\"color: red; font-size: 16px; text-align: left;\"><b>$error</b></p>";
              }
              ?>
              <a href="forgot-password.php">I forgot my password</a><br>
              <a href="register.php" class="text-center">Register a new membership</a>

            </div><!-- /.login-box-body -->
          </div>

          <div class="col-md-4">
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
      $("#login_form").validate();
    });
    localStorage.setItem("preVal", "2");
  </script>
</body>

</html>