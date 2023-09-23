<?php
include_once('lib/database.php');
$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

if (isset($_POST['submit'])) {
  $conn = OpenCon();
  //$conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  } else {
    $succ = "Connection established";
  }


  $dnow = $_POST['overnight'];
  $s1_month = $_POST['1month'];
  $s3_month = $_POST['3month'];
  $s12_month = $_POST['12month'];
  $s_6month = $_POST['6month'];
  $annual = $_POST['annual'];


  $i = 1;

  $sql = "UPDATE `benchmark-rate` SET overnight='$dnow', 1month='$s1_month', 3month='$s3_month', 6month='$s_6month', 12month='$s12_month', annual='$annual' WHERE id=1";


  if ($conn->query($sql) === TRUE) {
    $succ = "Record updated successfully";
    #echo $succ;
  } else {
    $err = "Error updating record: " . $conn->error;
    #echo $err;
  }

  $conn->close();
}


if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['sessCustomerID'])) {
  if ($_SESSION['sessCustomerID'] == "7" || $_SESSION['sessCustomerID'] == "628") {
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
  <title>Benchmark Rates | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Update Benchmark Rates</h4>
      </div>
    </div>
  </div>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box">
            <div class="box-header" style="float: right; padding-top: 20px">
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;"> <button class="btn btn-primary"><a style="color: white;" href="profile">Back To Profile</a></button>
                </div>
              </div>
            </div>
            <!-- /.box-header -->

            <form action="" method="post" style="padding-top: 80px;">

              <div class="box-body table-responsive">
                <table class="table table-hover">
                  <?php
                  //Create connection
                  //$conn = new mysqli($servername, $username, $password, $dbname);
                  $conn = OpenCon();
                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $query = "SELECT * FROM `benchmark-rate` WHERE id=1";
                  $result3 = $conn->query($query);

                  while ($row3 = $result3->fetch_assoc()) {
                    #               $dnow = $_POST['overnight'];
                    #$1month = $_POST['1month'];
                    #$wfrom = $_POST['3month'];
                    #$wto = $_POST['weekTo'];
                    #$wtext = $_POST['6month'];
                    #$month = $_POST['month'];
                    #$annual = $_POST['annual'];
                    #$endday = $_POST['endDay'];
                  ?>
                    <tr>
                      <td style="font-size: 16px;"><strong>OverNight</strong></td>
                      <td colspan="2"><input id="overnight" name="overnight" class="form-control" type="text" value="<?php echo $row3['overnight']; ?>" /></td>
                    </tr>
                    <tr>
                      <td style="font-size: 16px;"><strong>1 Month</strong></td>
                      <td colspan="2"><input id="1month" name="1month" class="form-control" value="<?php echo $row3['1month']; ?>"></td>
                    </tr>
                    <tr>
                      <td style="font-size: 16px;"><strong>3 Months</strong></td>
                      <td colspan="2"><input id="3month" name="3month" class="form-control" value="<?php echo $row3['3month']; ?>" /></td>

                    </tr>
                    <tr>
                      <td style="font-size: 16px;"><strong>6 Month</strong></td>
                      <td colspan="2"><input id="6month" name="6month" class="form-control" value="<?php echo $row3['6month'] ?>"></td>
                    </tr>
                    <tr>
                      <td style="font-size: 16px;"><strong>12 Month</strong></td>
                      <td colspan="2"><input id="12month" name="12month" class="form-control" value="<?php echo $row3['12month']; ?>" /></td>
                    </tr>
                    <tr>
                      <td style="font-size: 16px;"><strong>Repo Rate</strong></td>
                      <td colspan="2"><input id="annual" name="annual" class="form-control" value="<?php echo $row3['annual']; ?>"></td>
                    </tr>

                  <?php
                  }

                  $conn->close();
                  ?>

                  <tr>
                    <td></td>
                    <td colspan=2><button name="submit" value="Submit" id="submit_form" class="btn btn-warning"><i class="fa fa-save fa-lg" style=""> Update All </i></button></td>
                  </tr>


                </table>
              </div>
              <!-- /.box-body -->
            </form>

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