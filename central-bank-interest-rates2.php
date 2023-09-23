<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="Know current Repo rate and Reverse Repo Rate, Current SOFR Rate, Libor Rate Today, Euribor, GBP Libor, JPY Libor & other benchmark rates. Visit now!">
  <meta name="keywords" content="libor rate today,euribor,central bank interest rates,euro interbank offered rate,gbp libor">

  <title>SOFR | IBR Live</title>
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
   <!-- Global site tag (gtag.js) - Google Analytics -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-123754068-1');
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
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: white;">

    <!-- Main content -->
    <section class="content">
          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  
                  <p class="box-title" style="font-size: 22px;"><b>Repo Rate </p>
                  <font style="font-size: 16px;"></b></font>
                </div>
    
              <div class="box-body pad " id="no-more-tables">

                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                    <thead class="cf">
                       
                      <tr>
                        <th class="numeric" >
                          <h4><b>Term</b></h4>
                        </th>
                        <th  class="numeric">
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
              </div>
              
              
              <!-- sofr end -->
              
             
              
              
               
              
              <!-- other end -->
            </div><!-- /.col -->

             <div class="col-md-12" style="margin-top: 10px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  
                  <p class="box-title" style="font-size: 22px;"><b>SOFR (Secured Overnight Financing Rate) </p>
                  <font style="font-size: 16px;"></b></font>
                </div>
                <div class="box-body pad " id="no-more-tables">

                  <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
                    <thead class="cf">
                        <tr><td colspan="2">
                          <h5>SOFR is published by the <b>New York Federal Reserve</b> each business day for the previous business day and the latest rates are displayed as below:<br /></h5>
                        </td></tr>
                      <tr>
                        <th class="numeric" >
                          <h4><b>Term</b></h4>
                        </th>
                        <th  class="numeric">
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
              
              
              <!-- sofr end -->
              
             
              
              
               
              
              <!-- other end -->
            </div><!-- /.col -->
          </div><!-- ./row -->
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
}else{
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
	
                while($row3 = $result3->fetch_assoc()){ 

                  ?>
                  <script>
                    $( document ).ready(function() {
                
                  $('#euribor_month').text(<?php echo $row3['1month'];?>);
                  $('#euribor_3').text(<?php echo $row3['3month'];?>);
                  $('#euribor_6').text(<?php echo $row3['6month'];?>);
                  $('#euribor_12').text(<?php echo $row3['12month'];?>);
                  $('#annual').text(<?php echo $row3['annual'];?>);
                  $.ajax({
      method: 'GET',
      url: 'https://api.api-ninjas.com/v1/interestrate',
      headers: {
        'X-Api-Key': 'L6VHnSumhEitGLFRJJRjyw==Z4slmFQQNRgGPUhO'
      },
      contentType: 'application/json',
      success: function(result) {
       


       
        $('#sofr').text(result.non_central_bank_rates[15].rate_pct);
       


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