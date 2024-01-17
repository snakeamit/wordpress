<?php
//require '../lib/database.php';
if (strpos($_SERVER['REMOTE_ADDR'], "157.36.10.52") === 0) {
  die();
}

if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
$allow = "";
if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  //$allow = $_SESSION['userallow']; 
  $subcription_chk = $_SESSION['SUBSCRIPTION_CHECKING'];
} else {
  if (!empty($_COOKIE['email']) && !empty($_COOKIE['token'])) {
    $servername = "localhost";
    // $username = "root";
    // $password = "";
    $username = "ibrlive";
    $password = "tubelight";
    $dbname = "ibrMock";

    $allow = "";
    //Create connection
    //$conn = OpenCon();
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $email = $_COOKIE['email'];
    $token = $_COOKIE['token'];

    $sqld = "SELECT id, name, phone, paid, created, validity, amount,passcookie FROM customers WHERE email='$email'";
    $result = $conn->query($sqld);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hash = $row['passcookie'];
        if ($hash == "") {
        } else {
          $auth = password_verify($token, $hash);
          if ($auth == 1) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['sessCustomerID'] = $row['id'];
            $_SESSION['userallow'] = $row['paid'];
            $user = $_SESSION['username'] = $row['name'];
            $_SESSION['useremail'] = $email;
            $_SESSION['userphone'] = $row['phone'];
          }
        }
      }
    }
    $conn->close();
  } else {
    $user = "";
    $allow = "NO";
  }
}

?>
<script>
  function showMF() {
    document.getElementById("mfopt").style.display = "block", document.getElementById("feopt").style.display = "none"
  }

  function showFE() {
    document.getElementById("feopt").style.display = "block", document.getElementById("mfopt").style.display = "none"
  }

  function hideMFFE() {
    document.getElementById("feopt").style.display = "none", document.getElementById("mfopt").style.display = "none"
  }
</script>
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
  .blink_me {
    animation: blinker 1s linear infinite;

  }

  @keyframes blinker {
    50% {
      opacity: 0;
    }
  }
</style>

<div class="nav-cont">
  <nav class="navbar navbar-expand-lg navbar-dark py-3 py-lg-0">

    <div class="container">

      <a href="/home" class="navbar-brand p-0 mt-3">
        <h1 class="m-0"><img src="img/logo.png" alt="IBrlive Pvt Ltd" class="logo"></h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
          <a href="/home" class="nav-item nav-link active">Home</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
            <div class="dropdown-menu m-0">
              <a href="/usd-inr-forecast" class="dropdown-item">Forecast</a>
              <?php if($subcription_chk === "AVAILABLE") { ?>
                <a href="/forward-rates" class="dropdown-item">Forward rate</a>
              <?php } else { ?>
                <a href="/forward_rates_new" class="dropdown-item">Forward rate</a>
                <?php } ?>

              <a href="/central-bank-interest-rates" class="dropdown-item">Benchmark rate</a>
              <!-- <a href="/plans-and-pricing" class="dropdown-item">Rate Alert</a> -->
              <a href="/ratealerts" class="dropdown-item">Rate Alert</a>
              <a href="https://payment-forms-lrs.cashfree.com/ibr_live" class="dropdown-item">Send Money Abroad</a>
            </div>
          </div>
          <a href="/lei-code" class="nav-item nav-link">Get LEI</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Resources</a>
            <div class="dropdown-menu m-0">
              <a href="/blogs" class="dropdown-item">Blogs</a>
              <a href="https://ibrlive.estudium.org/products/Paid-NISM-Series%20V-A-Mutual%20Funds-English" target="_blank" class="dropdown-item">Mutual Funds</a>
              <a href="https://ibrlive.estudium.org/products/Paid-IIBF-FE-Foreign%20Exchange-English" target="_blank" class="dropdown-item">Foreign Exchange</a>
              <a href="/rbi-master-directions" class="dropdown-item">RBI Master Directions</a>
            </div>
          </div>
          <a href="/plans-and-pricing" class="nav-item nav-link">Plan and Pricing</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Company</a>
            <div class="dropdown-menu m-0">
              <a href="/about" class="dropdown-item">About</a>
              <a href="/contact" class="dropdown-item">Contact Us</a>
              <a href="/partnership-program" class="dropdown-item">Partnership Program</a>
            </div>
          </div>
        </div>
        <?php if ($user == "") { ?>

          <div class="dropdown px-4 ms-3">
            <button class="btn btn-secondary dropdown-toggle my-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="/register">New User</a></li>
              <li><a class="dropdown-item" href="/login">Existing User</a></li>
            </ul>
          </div>

        <?php } else { ?>
          <div class="dropdown px-4 ms-3">
            <button class="btn btn-secondary dropdown-toggle my-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li class="dropdown-item"><a href="#"><b> <?= $user ?> </b></a></li>
              <li class="dropdown-item"><a href="/profile"><b>My Profile</b></a></li>
              <li class="dropdown-item"><a href="/viewCart"><b>View Cart</b></a></li>
              <li class="dropdown-item"><a href="/logout"><b>Logout</b></a></li>
            </ul>
          </div>
        <?php } ?>
      </div>

    </div>
  </nav>
</div>