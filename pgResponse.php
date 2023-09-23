<?php
// if (session_id() == '' || !isset($_SESSION)) {
//   session_start();
// }
session_start();
// include database configuration file
include 'dbConfig.php';
require_once 'lib/ShoppingCart.php';
$shoppingCart = new ShoppingCart();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="windows-1252">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Payment Status | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once('include/head.php') ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    ._failed {
      border-bottom: solid 4px red !important;
    }

    ._failed i {
      color: red !important;
    }

    ._warning {
      border-bottom: solid 4px darkgoldenrod !important;
    }

    ._warning i {
      color: darkgoldenrod !important;
    }

    ._success {
      box-shadow: 0 15px 25px #00000019;
      padding: 45px;
      width: 100%;
      text-align: center;
      margin: 40px auto;
      border-bottom: solid 4px #28a745;
    }

    ._success i {
      font-size: 55px;
      color: #28a745;
    }

    ._success h2 {
      margin-bottom: 12px;
      font-size: 40px;
      font-weight: 500;
      line-height: 1.2;
      margin-top: 10px;
    }

    ._success p {
      margin-bottom: 0px;
      font-size: 18px;
      color: #495057;
      font-weight: 500;
    }

    .tab_st {
      border-collapse: collapse;
      width: 64%;
      margin-left: 250px;
      text-align: center;
      table-layout: fixed;
    }
  </style>

</head>

<body>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

  <body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
      <div class="spinner"></div>
    </div>
    <div class="container-fluid position-relative p-0 head-nav">
      <?php include_once('include/top-menu.php'); ?>

      <div id="header-carousel" class="slide-header">
        <div class="p-3" style="max-width: 900px; margin: 0 auto;">
          <h4 class="display-3 text-white mb-md-4 animated zoomIn">Your Transaction Status </h4>
        </div>
      </div>
    </div>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: white; ">

      <!-- Main content -->
      <section class="content" style="padding-top: 65px;">
        <div class="row">

          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="">
              <div class="box-body pad">
                <?php
                //header("Pragma: no-cache");
                //header("Cache-Control: no-cache");
                //header("Expires: 0");

                // following files need to be included
                require_once("./lib/config_paytm.php");
                require_once("./lib/encdec_paytm.php");

                $paytmChecksum = "";
                $paramList = array();
                $isValidChecksum = "FALSE";

                $paramList = $_POST;
                $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

                //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
                $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
                if ($isValidChecksum == "TRUE") {
                  //echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
                  if ($_POST["STATUS"] == "TXN_SUCCESS") {
                    //$customerid = $_SESSION['sessCustomerID'];

                    $orderid = $_POST['ORDERID'];
                    $sql = "SELECT customer_id from transactions where order_id= '$orderid'";

                    // Process the query
                    $results = $db->query($sql);
                    // print_r($results->num_rows);
                    $err = '';
                    if ($results->num_rows > 0) {
                      $row = $results->fetch_assoc();
                    }

                    $shoppingCart->emptyCart($row['customer_id']);

                    $txnid =  isset($_POST['TXNID']) && !empty($_POST['TXNID']) ? $_POST['TXNID'] : '';
                    $amount = $_POST['TXNAMOUNT'];
                    $payment_mode = isset($_POST['PAYMENTMODE']) && !empty($_POST['PAYMENTMODE']) ? $_POST['PAYMENTMODE'] : '';
                    //$txndate = $_POST['TXNDATE'];
                    $status = $_POST['STATUS'];
                    $response_code =  isset($_POST['RESPCODE']) && !empty($_POST['RESPCODE']) ? $_POST['RESPCODE'] : '';
                    $response_msg = isset($_POST['RESPMSG']) && !empty($_POST['RESPMSG']) ? $_POST['RESPMSG'] : '';
                    $gateway_name = isset($_POST['GATEWAYNAME']) && !empty($_POST['GATEWAYNAME']) ? $_POST['GATEWAYNAME'] : '';
                    //echo "UPDATE transactions SET transaction_id = '$txnid' , payment_mode = '$payment_mode', gateway_name='$gateway_name', status = '$status', response_code='$response_code', response = '$response_msg',  WHERE order_id = '$orderid'";
                    $insert = $db->query("UPDATE transactions SET transaction_id = '$txnid' , payment_mode = '$payment_mode', gateway_name='$gateway_name', status = '$status', response_code='$response_code', response = '$response_msg' WHERE order_id = '$orderid'");
                    // $db->query("INSERT INTO transactions (customer_id, order_id, transaction_id, payment_mode, gateway_name, status, amount, response_code, response, txndate) VALUES ('$customerid', '$orderid', '$txnid', '$payment_mode', '$gateway_name', '$status', '$amount', '$response_code','$response_msg', '$txndate')");    
                    // print_r($_POST);   
                ?>

                    <!-- //Process your transaction here as success transaction.
   		        //Verify amount & order id received from Payment gateway with your application's order id and amount. -->

                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <h4 style="float: right; font-weight: 100;">Return to <a href="/profile"> my account</a></h4>
                        <div class="message-box _success">
                          <i class="fa fa-check-circle" aria-hidden="true"></i>
                          <h2> Your payment was successful </h2>
                          <p> Thank you for your payment. You can now use the premium features of FXpress Standard<br>
                            Transaction details as below: </p>
                        </div>
                      </div>
                      <div class="col-md-3"></div>
                    </div>

                    <?php echo "<table class='tab_st'>";
                    $orderidresp = 0;

                    foreach ($_POST as $paramName => $paramValue) {
                      switch ($paramName) {
                        case "ORDERID":
                          echo "<tr><td style='padding: 7px; border:1px solid;'>" . "Order ID: " . "</td><td style='padding: 7px; border:1px solid;'>" . $paramValue . "</td></tr>";
                          $orderidresp = $paramValue;

                          break;

                        case "TXNID":
                          echo "<tr><td style='padding: 7px; border:1px solid;'>" . "Transaction ID: " . "</td><td style='padding: 7px; border:1px solid;'>" . $paramValue . "</td></tr>";
                          break;

                        case "TXNAMOUNT":
                          echo "<tr><td style='padding: 7px; border:1px solid;'>" . "Transaction Amount (In Rupees): " . "</td><td style='padding: 7px; border:1px solid;'>" . $paramValue . "</td></tr>";
                          break;

                        case "TXNDATE":
                          echo "<tr><td style='padding: 7px; border:1px solid;'>" . "Transaction Date: " . "</td><td style='padding: 7px; border:1px solid;'>" . $paramValue . "</td></tr>";
                          break;

                        case "BANKTXNID":
                          echo "<tr><td style='padding: 7px; border:1px solid;'>" . "Bank Transaction ID: " . "</td><td style='padding: 7px; border:1px solid;'>" . $paramValue . "</td></tr>";
                          break;

                        case "BANKNAME":
                          echo "<tr><td style='padding: 7px; border:1px solid;'>" . "Bank Name: " . "</td><td style='padding: 7px; border:1px solid;'>" . $paramValue . "</td></tr>";
                          break;

                        default:
                          //no code here
                      }
                    }

                    $sstr = explode('-', $orderidresp);
                    $orderidresp = $sstr[1];

                    #echo "Order ID: ";
                    #echo $orderidresp;

                    #$sstr = split ("-", $paramValue); 
                    #$orderidresp = $sstr[1];

                    $query = $db->query("SELECT customer_id FROM orders WHERE id = " . $orderidresp);
                    $row = $query->fetch_assoc();
                    $customeridresp = $row['customer_id'];

                    #echo "Customer ID: ";
                    #echo $customeridresp;

                    $query2 = $db->query("SELECT product_id FROM order_items WHERE order_id = " . $orderidresp);

                    $pitems = array();
                    $i = 0;
                    while ($row2 = $query2->fetch_assoc()) {
                      $pitems[$i] = $row2['product_id'];
                      $i = $i + 1;
                    }

                    $purchaseddate = date('Y-m-d');

                    $validity = 0;

                    foreach ($pitems as $val) {
                      switch ($val) {
                        case "7":  //MF-Standard
                          $validity = 365;
                          $expiredate = date('Y-m-d', strtotime("+365 day"));
                          break;

                        case "8":  //MF-Gold
                          $validity = 90;
                          $expiredate = date('Y-m-d', strtotime("+90 day"));
                          break;

                        case "9":  //MF-Platinum
                          $validity = 180;
                          $expiredate = date('Y-m-d', strtotime("+180 day"));
                          break;

                        case "10":  //FE-Standard
                          $validity = 90;
                          $expiredate = date('Y-m-d', strtotime("+90 day"));
                          break;

                        case "11":  //FE-Gold
                          $validity = 180;
                          $expiredate = date('Y-m-d', strtotime("+180 day"));
                          break;

                        case "12":  //FE-Platinum
                          $validity = 365;
                          $expiredate = date('Y-m-d', strtotime("+365 day"));
                          break;

                        default:
                          $validity = 0;
                          break;
                      }



                      if ($validity != 0 && $_POST["STATUS"] == "TXN_SUCCESS") {
                        $db->query("INSERT INTO subscription (customer_id, order_id, product_id, paid_on, expire_on, status) VALUES ('$customeridresp', '$orderidresp', '$val', '$purchaseddate', '$expiredate', 'AVAILABLE')");

                        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                        $dateNow = $date->format('Y-m-d');

                        // if ($val == "1" || $val == "2" || $val == "3")
                        //   $_SESSION['MFEXAM'] = "AVAILABLE";

                        // if ($val == "4" || $val == "5" || $val == "6")
                        //   $_SESSION['FEEXAM'] = "AVAILABLE";
                      }
                    }
                    // echo $validity;
                    //die;
                    echo "</table>";
                  } else if ($_POST["STATUS"] === 'TXN_FAILURE') { ?>
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6 justify-content-md-center">
                        <h4 style="float: right; font-weight: 100;">Return to <a href="/profile"> my account</a></h4>
                        <div class="message-box _success _failed">
                          <i class="fa fa-times-circle" aria-hidden="true"></i>
                          <h2> Your payment failed </h2>
                          <p> Transaction Details : </p>
                          <br />
                          <table class="table table-borderless">
                            <tr>
                              <td class="text-right">Order ID :</td>
                              <td class="text-left"><?php echo $_POST['ORDERID']; ?></td>
                            </tr>
                            <tr>
                              <td class="text-right">Transaction ID :</td>
                              <td class="text-left"><?php echo $_POST['TXNID']; ?></td>
                            </tr>
                            <tr>
                              <td class="text-right">Amount :</td>
                              <td class="text-left"><?php echo $_POST['TXNAMOUNT']; ?></td>
                            </tr>
                            <?php if (isset($_POST['PAYMENTMODE'])) { ?>
                              <tr>
                                <td class="text-right">Payment Mode :</td>
                                <td class="text-left"><?php echo $_POST['PAYMENTMODE']; ?></td>
                              </tr>
                            <?php } ?>
                            <tr>
                              <td class="text-right">Response :</td>
                              <td class="text-left"><?php echo $_POST['RESPMSG']; ?></td>
                            </tr>
                          </table>

                        </div>
                      </div>
                      <div class="col-md-3"></div>
                    </div>

                  <?php
                    //$customerid = $_SESSION['sessCustomerID'];
                    $orderid = $_POST['ORDERID'];
                    $txnid =  isset($_POST['TXNID']) && !empty($_POST['TXNID']) ? $_POST['TXNID'] : '';
                    $amount = $_POST['TXNAMOUNT'];
                    $payment_mode = isset($_POST['PAYMENTMODE']) && !empty($_POST['PAYMENTMODE']) ? $_POST['PAYMENTMODE'] : '';
                    //$txndate = $_POST['TXNDATE'];
                    $status = $_POST['STATUS'];
                    $response_code =  isset($_POST['RESPCODE']) && !empty($_POST['RESPCODE']) ? $_POST['RESPCODE'] : '';
                    $response_msg = isset($_POST['RESPMSG']) && !empty($_POST['RESPMSG']) ? $_POST['RESPMSG'] : '';
                    $gateway_name = isset($_POST['GATEWAYNAME']) && !empty($_POST['GATEWAYNAME']) ? $_POST['GATEWAYNAME'] : '';
                    //echo "UPDATE transactions SET transaction_id = '$txnid' , payment_mode = '$payment_mode', gateway_name='$gateway_name', status = '$status', response_code='$response_code', response = '$response_msg',  WHERE order_id = '$orderid'";
                    $insert = $db->query("UPDATE transactions SET transaction_id = '$txnid' , payment_mode = '$payment_mode', gateway_name='$gateway_name', status = '$status', response_code='$response_code', response = '$response_msg' WHERE order_id = '$orderid'");
                    // $db->query("INSERT INTO transactions (customer_id, order_id, transaction_id, payment_mode, gateway_name, status, amount, response_code, response, txndate) VALUES ('$customerid', '$orderid', '$txnid', '$payment_mode', '$gateway_name', '$status', '$amount', '$response_code','$response_msg', '$txndate')");    
                    // print_r($_POST); 
                  }

                  ?>
                <?php
                } else { ?>
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 justify-content-md-center">
                      <div class="message-box _success _warning">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <h2> Invalid Transaction! </h2>
                        <p> Seems like there is some server issue or transaction not valid. Please try later. Thanks </p>
                      </div>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                <?php  }

                ?>
              </div>
            </div>
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