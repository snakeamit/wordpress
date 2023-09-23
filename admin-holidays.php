<?php

if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

if (isset($_POST['submitHoliday'])) {
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  } else {
    $succ = "Connection established";
  }

  $dh = $_POST['dateHoliday'];
  //echo $dh;

  $sql = "INSERT INTO holidays (holiday) VALUES ('$dh')";

  if ($conn->query($sql) === TRUE) {
    $succ = " Record Added successfully";
    //echo $succ;
  } else {
    $err = " Error adding record: " . $conn->error;
    //echo $err;
  }
  $conn->close();
}

if (isset($_POST['holidayDel'])) {
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  } else {
    $succ = "Connection established";
  }

  $idd = $_POST['holidayDel'];
  //echo $idd;

  $sql = "DELETE FROM holidays WHERE id=$idd";

  if ($conn->query($sql) === TRUE) {
    $succ = " Record Deleted successfully";
    //echo $succ;
  } else {
    $err = " Error deleting record: " . $conn->error;
    //echo $err;
  }
  $conn->close();
}

if (isset($_SESSION['sessCustomerID'])) {
  if ($_SESSION['sessCustomerID'] == "7") {
  } else {
    header("Location: profile.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}

if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  $allow = $_SESSION['userallow'];
} else {
  $user = "";
  $allow = "";
}

if ($user == "") {
  header("Location: login.php");
  exit();
} else {
  if ($allow == "") {
  } else {
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>List of holidays | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include_once('include/head.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .no-border {
      border-width: 0px;
      border: none
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">List of Holidays</h4>
      </div>
    </div>
  </div>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">

    <!-- Content Wrapper. Contains page content -->
    <div class="row">

      <div class="col-md-3">

      </div>

      <div class="col-md-6">
        <div class="box">
          <div class="box-header">
            <td>
              <h3 class="box-title"><b>List of Holidays</b></h3>
            </td>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;"> <button class="btn btn-primary"><a style="color: white;" href="profile">Back To Profile</a></button>
              </div>
            </div>
          </div>
          <!-- /.box-header -->

          <div class="box-body table-responsive no-padding">
            <form action="" method="post">
              <table class="table table-striped">
                <tr>
                  <th>Date (Holiday) </th>
                </tr>
                <tr>
                  <td><input name="dateHoliday" id="dateHoliday" type="date" style="color:blue; font-size: 16px; border-width:0px; border:none;">

                    <button name="submitHoliday" value="Submit" id="submitHoliday" class="btn btn-warning"><i class="fa fa-arrow-right" style=""> Add Holiday </i></button>
                  </td>

                </tr>
                <tr>
                  <td></td>
                </tr>
              </table>
            </form>
          </div>

          <div class="box-body table-responsive no-padding">

            <table class="table table-hover table-bordered" style="width: 99%;">
              <tr>

              </tr>
              <tr style="background-color: orange; color: white;">
                <th>Sr. No.</th>
                <th style="display: none;">Id</th>
                <th>Holiday Date</th>
                <th>Delete</th>
              </tr>

              <?php
              //Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);

              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $custId = $_SESSION['sessCustomerID'];
              $query = "SELECT id, holiday FROM holidays ORDER BY holiday ASC";
              $result2 = $conn->query($query);

              $pname = "";
              $m = 0;

              ?>
              <form action="" method="post">
                <?php
                $d = 0;
                while ($row2 = $result2->fetch_assoc()) {
                  $d++;
                  $idd = $row2['id'];
                  echo "<tr>
                  <td><input id='holiday-" . $d . "' type='text' name='holiday-" . $d . "' readonly class='no-border' value=" . $d . "></td>
                  <td style='display: none;'><input id='holidayId-" . $d . "' type='text' name='holidayId-" . $d . "' readonly class='no-border' value=" . $row2['id'] . "></td>
                  <td><input id='holidayDt-" . $d . "' type='text' name='holidayDt-" . $d . "' readonly class='no-border' value=" . date('d-m-Y', strtotime($row2['holiday'])) . "></td>
                  
                  <td><button name='holidayDel' value='$idd' id='$d' class='btn btn-danger'>Delete</button></td>
                  
                  </tr>";
                }
                $conn->close();
                ?>

              </form>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-3">

      </div>

    </div>

  </div>

  <?php include_once("include/footer.php"); ?>
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