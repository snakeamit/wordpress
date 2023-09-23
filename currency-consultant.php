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
  <title>Currency Consultant | IBR Live</title>
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
          <div class="row" style="font-size: 20px;">
            <!-- right column -->
            <div class="col-md-12" style="">
            <h2 class="text-center mt-0">Currency Consultant (1 post)</h2>
			
                <hr class="divider my-4" />
				
                <h3 class="mb-4 text-center">Joining: Immediate</h3>
                <h3 class="mb-4 text-center">Location: Remote</h3>
                <h3 class="mb-4 text-center">Job category: Part time</h3>
                <p>We are searching for an experienced foreign exchange dealer who can provide us insights about currency market & currency forecast.</p>
                <p><strong>Job Responsibilities:</strong></p>
                <ul>
                    <li>Making currency forecast.</li>
                    <li>Provide training about currency market & its movements.</li>
                    <li>Writing opening and closing figures of USD/INR.</li>
                    <li>Writing brief note on USD/INR including movement for the day, factor affecting the pair and major events etc.</li>
                    <li>Guide about hedging strategies.</li>
                </ul>    

                <p><strong>Key skills required:</strong>
                <ul>
                    <li>Must spare at least one hour during the day.</li>
                    <li>2-3 years of experience as currency trader.</li>
                </ul>
                
                
                <p>Email your resume at <a href="mailto:contact@ibrlive.com">contact@IBRLive.com</a> </p>
                <p>Please mention job title in the subject field of the application.</p>
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
