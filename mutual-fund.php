<?php  

  if(isset($_SESSION['username'])){    
    $user = $_SESSION['username'];   
  
  }else{
    if(isset($_SESSION['sessCustomerID'])){
      
    }else{
      $user="";
      $allow="NO";      
    }
  }
 
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mutual Funds | IBR Live</title>
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


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <style>
    .btn-label {position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;}
    .btn-labeled {padding-top: 0;padding-bottom: 0;}
    .btn { margin-bottom:10px; }
    
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
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="">
                <div class="box-body">
                  
                <p class="text-center" style="font-size: 22px; color: #3378a0;"><b> Looking to pass Mutual Fund Distributors Certification Examination?</b></p>
                <hr class="divider">  
                
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2">
                    </div>
                    
                    <div class="col col-lg-3">
                        <img class="img-thumbnail" src="images/exam.jpg"/>
                    </div>
                
                    <div class="col col-lg-5 text-center">
                        <!--<a href="mf-mock-01"><button type="button" class="btn btn-labeled btn-lg btn-warning" style="padding: 20px; width: 300px;"><i class="fa fa-angle-double-right"></i> Take 5 Free Mock Tests</button></a>
                        <br/>
                        <a href="our-products"><button type="button" class="btn btn-labeled btn-lg btn-default" style="padding: 20px;  width: 300px;"><i class="fa fa-angle-double-right"></i> Subscribe Now <br/> All Tests in only &#8377; 99/- </button></a>
                        <a href="mutual-fund-test"><button type="button" class="btn btn-labeled btn-lg btn-success" style="padding: 20px;  width: 300px;"><i class="fa fa-angle-double-right"></i> Already Subscribed? <br/> Start now!</button></a>-->
                        <h3>Visit our new website <a href="https://ibrlive.estudium.org/">ibrlive.estudium.org</a> to access a wide range of mock test series. </h3><br/>
                        <a href="https://ibrlive.estudium.org/"><button type="button" class="btn btn-labeled btn-lg btn-success" style="padding: 20px;  width: 300px;"><i class="fa fa-angle-double-right"></i> Start now!</button></a>
                    </div>
                    
                    <div class="col col-lg-2">
                    </div>
                </div>
                
                <div class="row justify-content-md-center" style="margin-top: 10px;">
                    <hr class="divider" />
                    <div class="col col-lg-12">
                        <p style="font-size: 16px;">This test is mandatory for all persons involved in selling and distributing mutual funds including Individual Mutual Fund Distributors, Employees of organizations engaged in sales and distribution of Mutual Funds & Employees of Asset Management Companies specially persons engaged in sales and distribution of Mutual Funds.</p>
                        
                        <ul style="font-size: 16px;">
                            <li>We have made available a set of 25 mock tests prepared by experts in financial domain.</li>  
                            <li>All the questions included are within latest syllabus. </li>
                            <li>These tests will not only enhance your knowledge to pass the tests but also give you a real experience of how the tests are actually conducted digitally. </li>
                        </ul> 
                        
                        <hr class="divider" />
                    </div>
                    
                    <h4 class="text-center"><strong>Test details:</strong></h4>
                    <div class="col col-lg-12 table-responsive text-center">
                        <table class="table table-bordered ">
                            <thead class="bg-primary">
                                <tr>
                                    <td><strong>Test Duration (in minutes)</strong></td>
                                    <td><strong>No. of Questions</strong></td>
                                    <td><strong>Maximum Marks</strong></td>
                                    <td><strong>Pass Marks* (%)</strong></td>
                                    <td><strong>Validity of Certificate (Years)</strong></td>
                                    <td><strong>Negative Marking</strong></td>
                                </tr> 
                            </thead>
                            
                            <tbody class="bg-info">
                                <tr>
                                    
                                    <td><strong>120</strong></td>
                                    <td><strong>100</strong></td>
                                    <td><strong>100</strong></td>
                                    <td><strong>50</strong></td>
                                    <td><strong>3</strong></td>
                                    <td><strong>No</strong></td>
                                </tr>        
                            </tbody>    
                        </table>    
                    </div>
                </div>    
                    
                </div>
              </div><!-- /.box -->
            </div>
          </div><!-- ./row -->
    </section>
  </div>  

  <div class="text-right">
      <a href="https://www.freepik.com/vectors/school">Image credit freepik - www.freepik.com</a>
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
