<?php
include_once('lib/database.php');
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

session_start();
error_reporting(0);
$your_email = 'no-reply@ibrlive.com';

$errors = '';
$usename = '';
$subject = '';
$visitor_email = '';
$user_message = '';

$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";

//Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = OpenCon();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['change'])) {
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $otp = $_POST['otp'];
    $password = $_POST['password'];
    $repassword = $_POST['confirmpassword'];

    $_SESSION["passEmail"] = $email;
    $_SESSION["passPhone"] = $contact;

    if ($email == "") {
        $extra = "forgot-password";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Email is required";
        exit();
    }

    if ($contact == "") {
        $extra = "forgot-password";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Phone is required";
        exit();
    }

    if ($password == "") {
        $extra = "forgot-password";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Password is required";
        exit();
    }

    if ($password != $repassword) {
        $extra = "forgot-password";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Retyped Password does not match";
        exit();
    }

    if ($otp == "") {
        $extra = "forgot-password";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "OTP is required";
        exit();
    }


    $query = mysqli_query($conn, "SELECT otp FROM customers WHERE email='$email' and phone='$contact'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        if ($num['otp'] == $otp) {
            $extra = "forgot-password";
            $blank = 0;
            $password = password_hash($password, PASSWORD_DEFAULT);

            // mysqli_query($conn,"update customers set password='$password', otp='$blank' WHERE email='$email' and phone='$contact'");
            $sql = "update customers set password='$password', otp='$blank' WHERE email='$email' and phone='$contact'";
            //$result = $conn->query($sql);
            // if ($conn->query($sql) === TRUE) {
            //     echo "Record updated successfully";
            //   } else {
            //     echo "Error updating record: " . $conn->error;
            //   }
            //   die;
            //$sql = "INSERT INTO customers (id, name, email, phone, password, created, member) VALUES ('$idmax', '$nameuser', '$emailuser', '$phoneuser', '$passuser', '$dateToday', '$member')";
            if ($conn->query($sql) === TRUE) {
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("location:https://$host$uri/$extra");
                $_SESSION['errmsg'] = "Password Changed Successfully";

                $_SESSION["passEmail"] = "";
                $_SESSION["passPhone"] = "";
                exit();
            } else {
                $_SESSION['errmsg'] = "Somthing wrong please try after sometime!.";
                exit();
            }
        } else {
            $_SESSION['errmsg'] = "Invalid email id or Contact no";
            exit();
        }
    } else {
        $extra = "forgot-password";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Invalid email id or Contact no";

        exit();
    }
}

if (isset($_POST['genotp'])) {
    $visitor_email = $_POST['email'];
    $visitor_phone = $_POST['contact'];

    $_SESSION["passEmail"] = $visitor_email;
    $_SESSION["passPhone"] = $visitor_phone;

    if ($visitor_email == "") {
        $extra = "eForgot-password";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Email is required";
        exit();
    }

    if ($visitor_phone == "") {
        $extra = "forgot-password";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:https://$host$uri/$extra");
        $_SESSION['errmsg'] = "Phone is required";
        exit();
    }

    $fourdigitrandom = rand(1000, 9999);
    $email_otp = $fourdigitrandom;

    //add otp to db
    $query = mysqli_query($conn, "SELECT * FROM customers WHERE email='$visitor_email' and phone='$visitor_phone'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        mysqli_query($conn, "update customers set otp='$email_otp' WHERE email='$visitor_email' and phone='$visitor_phone' ");


        //send the email
        $to = $visitor_email;
        $from = $your_email;
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        $body = "<html><body><table><tr style='background: #eee;'><td><strong> OTP (One Time Password) to reset Password. (Valid till midnight) </strong></td>\n" .

            "<tr>
            <td><strong>Subject:</strong> 'OTP to change password'</td>
        </tr>\n" .

            "<tr>
			<td><strong>Email OTP:</strong> " . "$email_otp</td>
		</tr>
			</table></body></html>\n\n";
        $headers = array(
            "From: $from",
            "Reply-To: $your_email",
            "MIME-Version: 1.0",
            "Content-type:text/html;charset=UTF-8",
            "X-Mailer: PHP/" . PHP_VERSION
        );
        $headers = implode("\r\n", $headers);

        if (mail($to, 'IBRLive Login OTP', $body, $headers)) {
            $_SESSION['errmsg'] = "OTP Sent to your email. The email could take 4-5 minutes to deliver.";
        } else {
            $_SESSION['errmsg'] = "Error sending message. Try again later!";
        }
    } else {
        $_SESSION['errmsg'] = "Email or Phone not registered with us!";
    }
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password | IBR Live</title>
    <meta name="description" content="IBR-Live Login for existing users">
    <meta name="keywords" content="login, user, ibrlive">

    <!-- Tell the browser to be responsive to screen width -->
    <?php include_once('include/head.php'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <script type="text/javascript">
        function valid() {
            if (document.register.password.value != document.register.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.register.confirmpassword.focus();
                return false;
            }
            return true;
        }
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
                <h4 class="display-3 text-white mb-md-4 animated zoomIn">Existing User &ndash; Reset Password</h4>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-body">

                        <div class="col-md-6 col-sm-6 sign-in">
                            <form class="register-form outer-top-xs" name="register" method="post">
                                <span style="color:red;">
                                    <?php
                                    echo htmlentities($_SESSION['errmsg']);
                                    ?>
                                    <?php
                                    echo htmlentities($_SESSION['errmsg'] = "");
                                    ?>
                                </span>
                                <div class="form-group">
                                    <label class="info-title" for="email">Registered Email Address <span>*</span></label>
                                    <input type="email" name="email" class="form-control unicase-form-control text-input" value="<?php echo $_SESSION['passEmail']; ?>" id="email">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputPassword1">Registered Phone no. <span>*</span></label>
                                    <input type="text" name="contact" class="form-control unicase-form-control text-input" value="<?php echo $_SESSION['passPhone']; ?>" id="contact">
                                </div>

                                <button type="submit" class="btn-upper btn btn-info checkout-page-button" name="genotp">Generate OTP</button>

                                <div class="form-group">
                                    <label class="info-title" for="otp">Enter OTP from Email <span>*</span></label>
                                    <input type="tel" class="form-control unicase-form-control text-input" id="otp" name="otp" max="9999" min="1000" onKeyPress="if(this.value.length==4) return false;">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="password">New Password. <span>*</span></label>
                                    <input type="password" class="form-control unicase-form-control text-input" id="password" name="password">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="confirmpassword">Confirm Password. <span>*</span></label>
                                    <input type="password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword">
                                </div>

                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="change">Change</button>
                            </form>
                        </div>

                        <div class="col-md-3 col-sm-3">
                        </div>

                    </div><!-- /.box-body -->
                </div>
            </div>
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
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>

</html>