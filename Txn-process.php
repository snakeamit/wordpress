<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="GENERATOR" content="IBR Live Checkout"> 
  <title>Check Out | IBR Live</title>
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
  hr.divider {
		max-width: 3.25rem;
		border-width: 0.2rem;
		border-color: #f4623a;
	}
	</style>
</head>

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
                  <i class="fa fa-credit-card"></i>
                  <p class="box-title" style="font-size: 22px;"><b>IBR - Payment </p>
                  <hr class="divider">
                </div>
               
              </div>
            </div><!-- /.col -->

            <div class="col-md-4">
            </div>
            <div class="col-md-4" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
              <!-- general form elements disabled -->
              <div class="">
                <div class="box-body" align=center>
                  <form method="post" action="pgRedirect.php">
		<table class="table table-hover">
			<tbody>
				
				<tr>
					<td style="display:none;">1</td>
					<td><label>ORDER ID</label></td>
					<td><input style="outline:none; border-width:0px; border: none;" readonly id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "IBR-" . $_SESSION['orderid'] ?>">
					</td>
				</tr>
				<tr>
					<td style="display:none;">2</td>
					<td><label>CUSTOMER ID</label></td>
					<td><input style="outline:none; border-width:0px; border: none;" readonly id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $_SESSION['sessCustomerID']; ?>"></td>
				</tr>
				<tr style="display:none;">
					<td style="display:none;">3</td>
					<td><label>INDUSTRY_TYPE_ID ::*</label></td>
					<td><input style="outline:none; border-width:0px; border: none;" readonly id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
				</tr>
				<tr  style="display:none;">
					<td style="display:none;">4</td>
					<td><label>Channel ::*</label></td>
					<td><input style="outline:none; border-width:0px; border: none;" readonly id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
					</td>
				</tr>
				<tr>
					<td style="display:none;">5</td>
					<td><label>TRANSACTION AMOUNT (INDIAN RUPEES)</label></td>
					<td><input style="outline:none; border-width:0px; border: none;" readonly title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="<?php echo $_SESSION['totalprice']; ?>">
					</td>
				</tr>
				<tr>
					<td style="display:none;"></td>
					<td></td>
					<td><input class="btn btn-warning" value="Pay Now" type="submit" onclick=""></td>
				</tr>
			</tbody>
		</table>
		
	</form>          
                </div>               
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