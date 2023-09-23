<?php
include_once('lib/database.php');
$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

if (isset($_POST['dateUpdated'])) {
  // $conn = new mysqli($servername, $username, $password, $dbname);
  $conn = OpenCon();
  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  } else {
    $succ = "Connection established";
  }
  $updateDate = $_POST['dateUpdated'];
  $currPair = $_POST['currpair'];
  $col1 = $_POST['c1'];
  $col2 = $_POST['c2'];
  $col3 = $_POST['c3'];
  $col4 = $_POST['c4'];

  $sql = "UPDATE forecasthead SET pair='$currPair', c1='$col1', c2='$col2', c3='$col3', c4='$col4', updatedOn='$updateDate' WHERE id='1'";

  if ($conn->query($sql) === TRUE) {
    $succ = "Record updated successfully";
  } else {
    $err = "Error updating record: " . $conn->error;
  }

  for ($i = 1; $i <= 3; $i++) {
    $c1 = strval($_POST['c1-' . $i]);
    $c2 = $_POST['c2-' . $i];
    $c3 = $_POST['c3-' . $i];
    $c4 = $_POST['c4-' . $i];

    $sql = "UPDATE forecast SET c1='$c1', c2='$c2', c3='$c3', c4='$c4' WHERE id='$i'";

    if ($conn->query($sql) === TRUE) {
      $succ = "Record updated successfully";
    } else {
      $err = "Error updating record: " . $conn->error;
    }
  }

  $conn->close();
}


if (session_id() == '' || !isset($_SESSION)) {
  session_start();
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
  <title>Forecast | IBR Live</title>
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Currency Forecast</h4>
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
              <div class="box-body table-responsive no-padding">
                <table class="table">
                  <?php
                  //Create connection
                  //$conn = new mysqli($servername, $username, $password, $dbname);
                  $conn = OpenCon();
                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $query = "SELECT pair, c1, c2, c3, c4, updatedOn FROM forecasthead WHERE id=1";
                  $result2 = $conn->query($query);
                  ?>
                  <tr>
                    <?php
                    while ($row2 = $result2->fetch_assoc()) {

                      echo "
                    <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='dateUpdated' type='text' name='dateUpdated' class='no-border' value=" . $row2['updatedOn'] . "></td>
                    
                    <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #E8E8E8; color: black;' id='currpair' type='text' name='currpair' readonly class='no-border' value=" . $row2['pair'] . "></td>

                    <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c1' type='text' name='c1' class='no-border' value=" . $row2['c1'] . "></td>
                    
                    <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c2' type='text' name='c2' class='no-border' value=" . $row2['c2'] . "></td>
                    
                    <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c3' type='text' name='c3' class='no-border' value=" . $row2['c3'] . "></td>
                    
                    <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c4' type='text' name='c4' class='no-border' value=" . $row2['c4'] . "></td>
                    ";
                    }
                    ?>
                  </tr>
                </table>
              </div>

              <div class="box-body table-responsive no-padding">
                <table class="table">

                  <?php
                  $query = "SELECT id, pair, c1, c2, c3, c4 FROM forecast";
                  $result3 = $conn->query($query);

                  $pname = "";

                  ?>

                  <?php
                  $d = 0;
                  while ($row3 = $result3->fetch_assoc()) {
                    $d++;
                    echo "<tr>
                  <td><input id='uid-" . $d . "' type='text' name='uid-" . $d . "' readonly style='font-size: 16px; padding: 10px; text-align: center; background-color: #E8E8E8; color: black;' class='no-border' value=" . $row3['id'] . "></td>
                  <td><input id='pair-" . $d . "' type='text' name='pair-" . $d . "' readonly style='font-size: 16px; padding: 10px; text-align: center; background-color: #E8E8E8; color: black;' class='no-border' value=" . $row3['pair'] . "></td>
                  <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c1-" . $d . "' type='text' name='c1-" . $d . "' class='no-border' value=" . $row3['c1'] . "></td>
                  <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c2-" . $d . "' type='text' name='c2-" . $d . "' class='no-border' value=" . $row3['c2'] . "></td>
                  <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c3-" . $d . "' type='text' name='c3-" . $d . "' class='no-border' value=" . $row3['c3'] . "></td>
                  <td><input style='font-size: 16px; padding: 10px; text-align: center; background-color: #D6EAF8 ; color: black;' id='c4-" . $d . "' type='text' name='c4-" . $d . "' class='no-border' value=" . $row3['c4'] . "></td>
                  </tr>";
                  }

                  $conn->close();
                  ?>

                  <tr>
                    <td colspan="4"></td>
                    <td colspan=3><button name="submit" value="Submit" id="submit_form" class="btn btn-warning" style="float:right;"><i class="fa fa-save fa-lg" style=""> Save All </i></button></td>
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