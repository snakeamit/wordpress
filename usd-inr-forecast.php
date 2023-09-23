
<?php
include_once('lib/database.php');
if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
} else {
  if (isset($_SESSION['sessCustomerID'])) {
  } else {
    $user = "";
    $allow = "NO";
  }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ibrMock";

//Create connection
$conn = OpenCon();
//$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forecast | IBR Live</title>
  <meta name="description" content="Get Dollar to INR forecast for today, this week & this month. USD to INR prediction by experts based on technical & fundamental analysis. Our INR to USD Forecast is trusted by millions of trader. Visit now!">
  <meta name="keywords" content="usd to inr forecast,eur inr forecast,dollar to inr forecast,usd forecast,usd tomorrow,usd to inr prediction,us dollar forecast 2023,us dollar forecast,usd to inr forecast for next week,usd to inr forecast 2021,usd prediction,forex prediction">

  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once('include/head.php'); ?>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .btn-label {
      position: relative;
      left: -12px;
      display: inline-block;
      padding: 6px 12px;
      background: rgba(0, 0, 0, 0.15);
      border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
      padding-top: 0;
      padding-bottom: 0;
    }

    .btn {
      margin-bottom: 10px;
    }
  </style>

  <!-- Global site tag (gtag.js) - Google Analytics -->
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Currency Forecast</h4>
      </div>
    </div>
  </div>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: white;">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="">
                <div class="box-body">
                  <?php
                  $sql = "SELECT * FROM `curr-forecast` where id=1";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <div class="row justify-content-md-center" style="margin-top: 10px;">
                        <div class="col col-md-12" style="margin-top: 4px;">
                          <div class="card" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">
                              <div class="card-right">
                                <h4 style="color: #003366;"><strong>Daily Forecast ( Date: <?php echo date("d-m-Y", strtotime($row['dateNow']));  ?>)</strong></h4>
                                <hr />
                                <div style="font-weight: normal; font-size: 18px; color: black;">
                                  <?php
                                  echo '<p>' . preg_replace("~[\r\n]+~", '</p><p>', $row['dailyText']) . '</p>';
                                  ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col col-md-12" style="margin-top: 4px;">
                          <div class="card" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">
                              <div class="card-right">
                                <h4 style="color: #003366;"><strong>Weekly Forecast (<?php echo date("d-m-Y", strtotime($row['weekFrom']));  ?> to <?php echo date("d-m-Y", strtotime($row['weekTo']));  ?>)</strong></h4>
                                <hr />
                                <div style="font-weight: normal; font-size: 18px; color: black;">
                                  <?php
                                  echo '<p>' . preg_replace("~[\r\n]+~", '</p><p>', $row['weekText']) . '</p>';
                                  ?>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col col-md-12" style="margin-top: 4px;">
                          <div class="card" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">
                              <div class="card-right">
                                <h4 style="color: #003366;"><strong>Monthly Forecast (<?php echo $row['month'];  ?>)</strong></h4>
                                <hr />
                                <div style="font-weight: normal; font-size: 18px; color: black;">
                                  <?php
                                  echo '<p>' . preg_replace("~[\r\n]+~", '</p><p>', $row['monthText']) . '</p>';
                                  ?>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="col col-md-12" style="margin-top: 20px;">
                          <strong>Disclaimer:</strong>
                          <p> Currency forecasts are based on technical and fundamental analysis and taken from some trusted sources. IBR Live does not make its on forecasts. Forecasts may change frequently based on present facts and future events and may differ from actual prices. One should not fully rely on the above forecasts while making any financial decision. IBR live takes no responsibility on making any financial decisions based on the above forecasts.</p>
                        </div>
                      </div>
                    <?php
                    }
                  } else {
                    ?>
                    <h4 style="text-align: center;">No forecast is available.</h4>
                    <h4 style="text-align: center;">Please try again later.</h4>
                  <?php

                  }
                  ?>
                </div>
              </div><!-- /.box -->
            </div>
          </div><!-- ./row -->
        </section>
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
