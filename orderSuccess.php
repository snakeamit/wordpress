<?php
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];    
    $allow = $_SESSION['userallow']; 
  }else{
    $user="";
    $allow="";
  }

  if($user==""){
    header("Location: login.php"); 
    exit();
  }else{
    
  }

?>
<?php
if(!isset($_REQUEST['id'])){
    //header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success - IBR Live</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout | IBR Live</title>
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
    <style>
    .container{width: 100%;}
    p{color: #34a853;font-size: 18px;}

    
    </style>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header" align=center>
                  <i class="fa fa-star"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Order Status </p>
                </div>
                <div class="box-body pad table-responsive">
                  
                </div><!-- /.box -->
              </div>
            </div><!-- /.col -->
<div class="col-md-2">
</div>
            <div class="col-md-8">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p style="font-size: 18px; text-align: center;">Your order has submitted successfully. Order ID is #<?php echo $_SESSION['orderid']; ?></p>


        <section class="invoice">
          
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header" style="border-bottom: 1px solid #607D8B;"> 
                <img style="height: 50px;" src="pix.jpg">
				<p style="text-align: center; display: inline;"></p>
                <small class="pull-right"><strong>
				<br/>
				<strong>Email:</strong> contact@ibrlive.com
				<br/>
				<strong>Website:</strong> www.ibrlive.com
				</small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>Learn and Spread</strong><br>
                Haryana, India<br>               
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Detail of Buyer
              <address>
                <strong><p id="addressclient" style="display: inline;"><?php echo $user; ?></p></strong><br>
				
                <br>
                
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Order Number : </b><p style="display: inline" id="hinvoice"><?php echo $_SESSION['orderid']; ?></p><br/>
                            
              <b>Order Date : </b><p style="display: inline" id="hdate"><?php echo date('d-m-Y'); ?></p><br/>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table width="100%" class="table table-striped" id="new-bill2">
				
              </table> 		
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
		    <div class="col-xs-6" style="text-align: center;">
			</div>
			
			<div class="col-xs-6" style="text-align: center;">
            <table style="width: 100%;">			
			<tr>
				<td><b>Amount Payble </b></td> <td id="amountpay">Rs. <?php echo $_SESSION['totalprice']; ?>/-</td>
			</tr>
						
			</table>
            </div><!-- /.col -->
			
			<div class="col-xs-12" style="text-align: center;">
				<br/><br/><p style="text-align: center; font-size: 20px;"><b>Thank you!</b></p><br/><br/>
			</div>			
		     
			
            <!-- notice column -->
            <div class="col-xs-12" style="text-align: center;">
            <br/><p><b>NOTICE:</b> &bull; <i>All disputes subjects to Haryana Jurisdiction Only.</i> &bull; <i>E. & O.E.</i></p>
			<p>&bull; This is a computer generated Invoice and is valid without the signature and seal.</p>
            </div><!-- /.col --> 

			<div class="col-xs-12" style="text-align: center;">
            <table style="width: 100%;">
			<tr>
				<!-- <td><b>Bank Details: </b></td><td><b>Bank: </b></td><td style="border: 0;"></td>
				<td><b>A/C No </b></td><td><b> - </b></td><td style="border: 0;"></td>
				<td><b>IFSC Code </b></td><td><b> - </b></td></b>-->
			</tr>	
			<tr>
				<td style="border: 0"></td>
			</tr>
			</table>
            </div><!-- /.col -->
			<div class="col-xs-12" style="text-align: center;">
            <br/><p><b>Deal in : Live currency rates, Mock tests and more.</b></p>
            </div><!-- /.col --> 
			
          </div><!-- /.row -->   
		  
		  
		         
          </div><!-- /.row -->
		  
		  <br/>
          <!-- this row will not appear when printing -->
          <div class="row no-print" id="printbutton">
            <div class="col-xs-12" style="text-align: center;">
              <a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            </div>
            <div class="col-xs-12" style="text-align: center;">
              
            </div>
          </div>
        </section><!-- /.content -->  

                </div>               
             </div>           
          </div><!-- ./row -->
    </section>
  </div>  

  <div class="no-print">
  <?php include_once("include/footer.php"); ?>
  </div>
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