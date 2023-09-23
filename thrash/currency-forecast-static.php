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
  <title>Forecast | IBR Live</title>
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

   <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-123754068-1');
    </script>
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
                  
                <p class="text-center" style="font-size: 22px;"><b> Currency Forecast</b></p>
                <hr class="divider">  
                
                <div class="row justify-content-md-center" style="margin-top: 10px;">
                    <div class="col col-md-12" style="margin-top: 4px;">
                      <div class="card" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                          <div class="card-right">
                            <h4 style="color: #003366;"><strong>Date: 04-01-2022</strong></h4><hr/>
                            <p  style="font-weight: normal; font-size: 18px; color: black;">Yesterday Trade Deficit came at $21.99 bln, It is not a comfortable position for INR with trade deficit coming above $20 bln for 4 consecutive months. As per fundamental of Economics Higher the Deficit persists, more it puts pressure on Current Account Deficit (CAD) and Balance of Payments (BoP), and thus INR. We have also seen RBI intervention yesterday around 74.30. </p>
                            <p  style="font-weight: normal; font-size: 18px; color: black;">
For today we might see a gap up opening in Rupee, and it should sustain above 74.49 for a move towards 74.60/74.73. Below 74.25 downtrend resumes for 74.12/74.01
                            </p>
                          </div>
                        </div>
                      </div>  
                    </div>
                    <div class="col col-md-12" style="margin-top: 4px;">
                      <div class="card" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                          <div class="card-right">
                            <h4 style="color: #003366;"><strong>Weekly forecast (03-01-2022 to 07-01-2022)</strong></h4><hr/>
                            <p  style="font-weight: normal; font-size: 18px; color: black;">Range for this week 75.06-73.98. We have seen 2 week of sell off in Indian Rupee and with positioning of traders becoming net short , We can see sharp short covering once price rise above 74.55 towards 75.06.  Weekly support in range of 73.98-74.05. </p>
                            
                          </div>
                        </div>
                      </div>  
                    </div>
                     <div class="col col-md-12" style="margin-top: 4px;">
                      <div class="card" style="padding: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                          <div class="card-right">
                            <h4 style="color: #003366;"><strong>Monthly forecast (January 2022)</strong></h4><hr/>
                            <p  style="font-weight: normal; font-size: 18px; color: black;">Range for January  75.88-73.56, With Budget coming on 01 Feb it will keep Indian Rupee Volatile. </p>
                            
                          </div>
                        </div>
                      </div>  
                    </div>
                    
                    <div class="col col-md-12" style="margin-top: 20px;">
                    <strong>Disclaimer:</strong><p> Currency forecasts are based on technical and fundamental analysis and taken from some trusted sources. IBR Live does not make its on forecasts. Forecasts may change frequently based on present facts and future events and may differ from actual prices. One should not fully rely on the above forecasts while making any financial decision. IBR live takes no responsibility on making any financial decisions based on the above forecasts.</p>
                    </div>
                </div>    
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
