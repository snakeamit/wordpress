<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="Know current Repo rate and Reverse Repo Rate, Current SOFR Rate, Libor Rate Today, Euribor, GBP Libor, JPY Libor & other benchmark rates. Visit now!">
  <meta name="keywords" content="libor rate today,euribor,central bank interest rates,euro interbank offered rate,gbp libor">

  <title>SOFR | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once('include/head.php'); ?>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    hr.divider {
      max-width: 3.25rem;
      border-width: 0.2rem;
      border-color: #f4623a;
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Benchmark Rates</h4>
      </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid stat-bg pt-4 wow fadeInUp" style="background-color: white;">

    <!-- Main content -->
    <section class="content" style="padding-top: 120px;">
      <div class="row">
        <div class="col-md-12" style="margin-top: 10px;">
            <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div class="box-header" align=center>

                <h4><b>Repo Rate </h4>
                <font style="font-size: 16px;"></b></font>
              </div>

              <div class="box-body pad " id="no-more-tables">

                <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                  <thead class="cf">

                    <tr>
                      <th class="numeric">
                        <h4><b>Term</b></h4>
                      </th>
                      <th class="numeric">
                        <h4 style="display:inline;"> <b>Interest Rates %</b></h4>
                        </h4>
                      </th>
                    </tr>

                  </thead>
                  <tbody>

                    <tr>
                      <td class="numeric">
                        <h4><b>Annual</b></h4>
                      </td>
                      <td data-title="" id="annual"></td>

                    </tr>


                  <tbody>

                </table>

              </div><!-- /.box -->

            </div>

        </div><!-- /.col -->
        <div class="container">
          <div class="row">
            <div class="col-md-12" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>

                  <p class="box-title" style="font-size: 22px;"><b>SOFR (Secured Overnight Financing Rate) </p>
                  <font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body pad " id="no-more-tables">

                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                    <thead class="cf">
                      <tr>
                        <td colspan="2">
                          <h5>SOFR is published by the <b>New York Federal Reserve</b> each business day for the previous business day and the latest rates are displayed as below:<br /></h5>
                        </td>
                      </tr>
                      <tr>
                        <th class="numeric">
                          <h4><b>Term</b></h4>
                        </th>
                        <th class="numeric">
                          <h4 style="display:inline;"> <b>Interest Rates %</b></h4>
                          </h4>
                        </th>
                      </tr>

                    </thead>
                    <tbody>

                      <tr>
                        <td class="numeric">
                          <h4><b>Overnight</b></h4>
                        </td>
                        <td data-title="" id="sofr"></td>

                      </tr>
                      <tr>
                        <td class="numeric">
                          <h4><b>1 Month</b></h4>
                        </td>
                        <td data-title="" id="euribor_month2"></td>

                      </tr>
                      <tr>
                        <td class="numeric">
                          <h4><b>3 Months</b></h4>
                        </td>
                        <td data-title="" id="euribor_32"></td>

                      </tr>
                      <tr>
                        <td class="numeric">
                          <h4><b>6 Months</b></h4>
                        </td>
                        <td data-title="" id="euribor_62"></td>

                      </tr>
                      <tr>
                        <td class="numeric">
                          <h4><b>12 Months</b></h4>
                        </td>
                        <td data-title="" id="euribor_122"></td>

                      </tr>

                    <tbody>

                  </table>

                </div><!-- /.box -->

              </div>
            </div>
          </div>
        </div>


        <!-- sofr end -->
        <div class="col-md-12" style="margin-top: 10px;">
          <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="box-header" align=center>

              <p class="box-title" style="font-size: 22px;"><b>EURIBOR (Euro Interbank Offered Rate) </p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="box-body pad " id="no-more-tables">

              <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                <thead class="cf">
                  <tr>
                    <td colspan="2">
                      <h5>EURIBOR is published by the <b>European Money Markets Institute</b> every business day .<br /></h5>
                    </td>
                  </tr>
                  <tr>
                    <th class="numeric">
                      <h4><b>Term</b></h4>
                    </th>
                    <th class="numeric">
                      <h4 style="display:inline;"> <b>Interest Rates %</b></h4>
                      </h4>
                    </th>
                  </tr>

                </thead>
                <tbody>

                  <tr>
                    <td class="numeric">
                      <h4><b>1 Week</b></h4>
                    </td>
                    <td data-title="" id="euribor_week"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>1 Month</b></h4>
                    </td>
                    <td data-title="" id="euribor_month"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>3 Months</b></h4>
                    </td>
                    <td data-title="" id="euribor_3"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>6 Months</b></h4>
                    </td>
                    <td data-title="" id="euribor_6"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>12 Months</b></h4>
                    </td>
                    <td data-title="" id="euribor_12"></td>

                  </tr>

                <tbody>

              </table>

            </div><!-- /.box -->

          </div>
        </div>
        <!-- EURIBOR end -->
        <div class="col-md-12" style="margin-top: 10px;">
          <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="box-header" align=center>

              <p class="box-title" style="font-size: 22px;"><b>USD LIBOR (London Interbank Offer Rate) </p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="box-body pad " id="no-more-tables">

              <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                <thead class="cf">

                  <tr>
                    <th class="numeric">
                      <h4><b>Term</b></h4>
                    </th>
                    <th class="numeric">
                      <h4 style="display:inline;"> <b>Interest Rates %</b></h4>
                      </h4>
                    </th>
                  </tr>

                </thead>
                <tbody>

                  <tr>
                    <td class="numeric">
                      <h4><b>Overnight</b></h4>
                    </td>
                    <td data-title="" id="usd_overnight"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>1 Month</b></h4>
                    </td>
                    <td data-title="" id="usd_month"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>3 Months</b></h4>
                    </td>
                    <td data-title="" id="usd_3"></td>

                  </tr>


                <tbody>

              </table>

            </div><!-- /.box -->

          </div>
        </div>

        
        <div class="col-md-12" style="margin-top: 10px;">
          <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="box-header" align=center>

              <p class="box-title" style="font-size: 22px;"><b>Other important interest rates</p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="box-body pad " id="no-more-tables">

              <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                <thead class="cf">

                  <tr>
                    <th class="numeric">
                      <h4><b>Term</b></h4>
                    </th>
                    <th class="numeric">
                      <h4 style="display:inline;"> <b>Overnight Interest Rates %</b></h4>
                      </h4>
                    </th>
                  </tr>

                </thead>
                <tbody>

                  <tr>
                    <td class="numeric">
                      <h4><b>SONIA</b></h4>
                    </td>
                    <td data-title="" id="sonia"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>ESTER</b></h4>
                    </td>
                    <td data-title="" id="ester"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>SARON</b></h4>
                    </td>
                    <td data-title="" id="saron"></td>

                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b>TONAR</b></h4>
                    </td>
                    <td data-title="" id="tonar"></td>

                  </tr>


                <tbody>

              </table>

            </div><!-- /.box -->

          </div>







          <!-- other end -->
        </div><!-- ./row -->
    </section>
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
<?php

$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  $err = "Error! Try again Later!";
} else {
  $succ = "Connection established";
}
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM `benchmark-rate` WHERE id=1";
$result3 = $conn->query($query);

while ($row3 = $result3->fetch_assoc()) {

?>
  <script>
    $(document).ready(function() {
      $('#sofr').text(<?php echo $row3['overnight']; ?>);
      $('#euribor_month2').text(<?php echo $row3['1month']; ?>);
      $('#euribor_32').text(<?php echo $row3['3month']; ?>);
      $('#euribor_62').text(<?php echo $row3['6month']; ?>);
      $('#euribor_122').text(<?php echo $row3['12month']; ?>);
      $('#annual').text(<?php echo $row3['annual']; ?>);
      $.ajax({
        method: 'GET',
        url: 'https://api.api-ninjas.com/v1/interestrate',
        headers: {
          'X-Api-Key': 'L6VHnSumhEitGLFRJJRjyw==Z4slmFQQNRgGPUhO'
        },
        contentType: 'application/json',
        success: function(result) {


	  console.log(result);

          $('#tonar').text(result.non_central_bank_rates[8].rate_pct);

          $('#saron').text(result.non_central_bank_rates[7].rate_pct);
          $('#sonia').text(result.non_central_bank_rates[6].rate_pct);
          $('#ester').text(result.non_central_bank_rates[0].rate_pct);
          $('#euribor_week').text(result.non_central_bank_rates[1].rate_pct);
          $('#euribor_month').text(result.non_central_bank_rates[2].rate_pct);
          $('#euribor_3').text(result.non_central_bank_rates[3].rate_pct);
          $('#euribor_6').text(result.non_central_bank_rates[4].rate_pct);
          $('#euribor_12').text(result.non_central_bank_rates[5].rate_pct);
          $('#usd_month').text(result.non_central_bank_rates[10].rate_pct);
          $('#usd_3').text(result.non_central_bank_rates[11].rate_pct);
          $('#usd_overnight').text(result.non_central_bank_rates[9].rate_pct);
          $('#gbp_month').text(result.non_central_bank_rates[9].rate_pct);
          $('#gbp_3').text(result.non_central_bank_rates[10].rate_pct);

          $('#jpy_month').text(result.non_central_bank_rates[11].rate_pct);
          $('#jpy_3').text(result.non_central_bank_rates[12].rate_pct);



        },
        error: function ajaxError(jqXHR) {
          console.error('Error: ', jqXHR.responseText);
        }
      });
    });
  </script>

<?php
}

$conn->close();
?>
