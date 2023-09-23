<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
if (session_id() == '' || !isset($_SESSION)) {
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

  <?php include_once('include/head.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body">

  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <?php include_once('include/top-menu.php'); ?>

    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Checkout </h4>
      </div>
    </div>
  </div>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

      <div class="card">
        <div class="card-header">
          Checkout
        </div>
        <div class="card-body">

          <form method="post" action="/pgRedirect">
            <table class="table">
              <tbody>

                <tr>
                  <td style="display:none;">1</td>
                  <td><label>ORDER ID</label></td>
                  <td><input style="outline:none; border-width:0px; border: none;" readonly id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "IBR-" . $_SESSION['orderid'] ?>">
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
                <tr style="display:none;">
                  <td style="display:none;">4</td>
                  <td><label>Channel ::*</label></td>
                  <td><input style="outline:none; border-width:0px; border: none;" readonly id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                  </td>
                </tr>
                <tr>
                  <td style="display:none;">5</td>
                  <td><label>TRANSACTION AMOUNT (INDIAN RUPEES)</label></td>
                  <td><input style="outline:none; border-width:0px; border: none;" readonly title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $_SESSION['totalprice']; ?>">
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