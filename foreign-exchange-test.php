<?php  
  include("check-FE.php");

  if(isset($_SESSION['username'])){    
    $user = $_SESSION['username'];   
  
  }else{
    if(isset($_SESSION['sessCustomerID'])){
      
    }else{
      $user="";
      $allow="NO";      
    }
  }
 
  if (isset($_SESSION["FEEXAM"])) {
    if($_SESSION['FEEXAM'] == "AVAILABLE"){ 
      $allow="YES";
    }else{
      $allow="NO";   
    }
  }else{
    $allow="NO";     
  }

?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Foreign Exchange  | IBR Live</title>
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
  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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
              <div class="">
                <div class="box-header" align=center>
                  <i class="fa fa-envelope"></i>
                  <p class="box-title" style="font-size: 22px;"><b> IIBF's Certificate Course in Foreign Exchange </p>
                  <hr class="divider">
                </div>

              </div>
            </div><!-- /.col -->
            
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="">

                <div class="box-body">
                    <!-- text input -->
                    
                        <table id="example2" class="table table-bordered table-hover" style="text-align: center;">
                          <thead>
                          <tr style="background: #566573; color: white;">              
                            <th style="text-align: center;">MOCK TEST</th>
                            <th style="text-align: center;">QUESTIONS</th> 
                            <th style="text-align: center;">DURATION</th>
                            <th style="text-align: center;">STATUS</th>                             
                          </tr> 
                          </thead>

                          <tbody>
                          <tr style="background: #FFFFFF;">
                            <td><a href="fe-mock-0200.php" style="text-decoration: none;">Mock Test 01</a></td>
                            <td>10</td>
                            <td>10 Minutes</td>
                            <td>Available</td>
                          </tr> 
                          <tr style="background: #FFFFFF;">
                            <td><a href="fe-mock-0201.php" style="text-decoration: none;">Mock Test 02</a></td>
                            <td>10</td>
                            <td>10 Minutes</td>
                            <td>Available</td>
                          </tr>
                          <tr style="background: #FFFFFF;">
                            <td><a href="fe-mock-0202.php" style="text-decoration: none;">Mock Test 03</a></td>
                            <td>10</td>
                            <td>10 Minutes</td>
                            <td>Available</td>
                          </tr>
                          <tr style="background: #FFFFFF;">
                            <td><a href="fe-mock-0203.php" style="text-decoration: none;">Mock Test 04</a></td>
                            <td>10</td>
                            <td>10 Minutes</td>
                            <td>Available</td>
                          </tr>
                          <tr style="background: #FFFFFF;">
                            <td><a href="fe-mock-0204.php" style="text-decoration: none;">Mock Test 05</a></td>
                            <td>10</td>
                            <td>10 Minutes</td>
                            <td>Available</td>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0205.php" style="text-decoration: none;">Mock Test 06</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0206.php" style="text-decoration: none;">Mock Test 07</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0207.php" style="text-decoration: none;">Mock Test 08</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>                          
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0208.php" style="text-decoration: none;">Mock Test 09</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0209.php" style="text-decoration: none;">Mock Test 10</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0210.php" style="text-decoration: none;">Mock Test 11</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0211.php" style="text-decoration: none;">Mock Test 12</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>  
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0212.php" style="text-decoration: none;">Mock Test 13</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>                          
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0213.php" style="text-decoration: none;">Mock Test 14</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0214.php" style="text-decoration: none;">Mock Test 15</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0215.php" style="text-decoration: none;">Mock Test 16</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0216.php" style="text-decoration: none;">Mock Test 17</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0217.php" style="text-decoration: none;">Mock Test 18</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0218.php" style="text-decoration: none;">Mock Test 19</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0219.php" style="text-decoration: none;">Mock Test 20</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0220.php" style="text-decoration: none;">Mock Test 21</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0221.php" style="text-decoration: none;">Mock Test 22</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0222.php" style="text-decoration: none;">Mock Test 23</a></td>
                            <td>25</td>
                            <td>60 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0223.php" style="text-decoration: none;">Mock Test 24</a></td>
                            <td>100</td>
                            <td>120 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0224.php" style="text-decoration: none;">Mock Test 25</a></td>
                            <td>100</td>
                            <td>120 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0225.php" style="text-decoration: none;">Mock Test 26</a></td>
                            <td>100</td>
                            <td>120 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>
                          <tr style="background: #D4E6F1;">
                            <td><a href="fe-mock-0226.php" style="text-decoration: none;">Mock Test 27</a></td>
                            <td>100</td>
                            <td>120 Minutes</td>
                            <?php 
                              if($allow=="NO" || $allow==""){
                                echo "<td><a href='https://ibrlive.estudium.org/#/signup' style='text-decoration: none;'>Register here</a></td>";
                              }else{
                                echo "<td>Available</td>";
                              } 
                            ?>
                          </tr>

                          </tbody>

                        </table> 
                   </div>
              </div><!-- /.box -->
            </div>
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
