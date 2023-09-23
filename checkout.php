<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  $allow = $_SESSION['userallow'];
} else {
  $user = "";
  $allow = "";
}

if ($user == "") {
  header("Location: login.php");
  exit();
}

?>
<?php
// include database configuration file
include 'dbConfig.php';

// initializ shopping cart class
include('lib/database.php');
require_once 'lib/ShoppingCart.php';
$shoppingCart = new ShoppingCart();

$tax = 18;
//Convert our percentage value into a decimal.
$percentInDecimal = $tax / 100;

// set customer ID in session
$_SESSION['sessCustomerID'] = $_SESSION['userid'];

$member_id = $_SESSION['sessCustomerID'];
$cartItem = $shoppingCart->getMemberCartItem($member_id);

// redirect to home if cart is empty
if (empty($cartItem)) {
  header("Location: index.php");
}
//$discount = '';
if (isset($_GET['discount'])) {
  $discount = $_GET['discount'];
}
// get customer details by session customer ID
$query = $db->query("SELECT * FROM customers WHERE id = " . $_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Checkout | IBR Live</title>

  <?php include_once('include/head.php') ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .table {
      width: 65%;
      float: left;
    }

    .shipAddr {
      width: 30%;
      float: left;
      margin-left: 30px;
    }

    .footBtn {
      width: 95%;
      float: left;
    }

    .orderBtn {
      float: right;
    }

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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Confirm Your Order </h4>
      </div>
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

      <div class="card">
        <div class="card-header">
          Confirm your order
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($cartItem)) {
                $item_total = 0;
                foreach ($cartItem as $item) {
              ?>

                  <tr>
                    <td><strong><?php echo $item["name"]; ?></strong></td>
                    <td><input type="text" maxlength="2" size="2" style='width: 50px; border-right:none;border-left:none;border-bottom:none;border-top:none' readonly class="form-control text-center" value="<?php echo $item["quantity"]; ?>"></td>
                    <td><?php echo "&#8377;" . $item["price"]; ?></td>

                  </tr>



                <?php
                  $item_total += ($item["price"] * $item["quantity"]);
                }
                $finalTax = $percentInDecimal * $item_total;
                ?>
                <tr>
                  <td colspan="2" align=right><strong>Total:</strong></td>
                  <td align=left><?php echo "&#8377;" . $item_total; ?></td>
                  <td></td>
                </tr>
                <?php if (isset($discount) && $discount !== '') {

                  $coupon_discount = $discount / 100;
                  $discount_amount = $item_total * $coupon_discount;

                  $finalTax = $percentInDecimal * ($item_total - $discount_amount);
                  $item_total  = $item_total - $discount_amount;

                  //  $finalTax = $percentInDecimal * ($item_total - $discount);
                  //  $item_total  = $item_total - $discount;
                ?>
                  <tr>
                    <td colspan="2" align=right><strong>Discount:</strong></td>
                    <td align=left><?php echo "&#8377;" . $discount_amount; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" align=right><strong>Taxes:</strong></td>
                    <td align=left><?php echo "&#8377;" . $finalTax; ?></td>
                    <td></td>
                  </tr>
                <?php } else { ?>

                  <tr>
                    <td colspan="2" align=right><strong>Taxes:</strong></td>
                    <td align=left><?php echo "&#8377;" . $finalTax; ?></td>
                    <td></td>
                  </tr>
                <?php } ?>

                <tr>
                  <td colspan="2" align=right><strong>Final Price:</strong></td>
                  <td align=left><?php echo "&#8377;" . ($item_total + $finalTax); ?></td>
                  <td></td>
                </tr>
              <?php } else { ?>
                <tr>
                  <td colspan="5">
                    <p>Your cart is empty...</p>
                  </td>
                <?php }
                ?>
            </tbody>

          </table>

          <div class="shipAddr">
            <h4><b>Client Details</b></h4>
            <p><?php echo $custRow['name']; ?></p>
            <p><?php echo $custRow['email']; ?></p>
            <p><?php echo $custRow['phone']; ?></p>

            <p><b>Add GST Details</b></p>
            <form id="add_gst" action="" method="post" >
              <p>GST No: <input type="text" id="gst_no" class="form-control gst_no" value="<?php echo $gst_no = isset($custRow['gst_no']) ? $custRow['gst_no'] : '';?>"></p>
              <p>Address: <textarea rows="5" cols="30" id="gst_address" class="form-control gst_address"><?php echo $gst_add = isset($custRow['gst_address']) ? $custRow['gst_address'] : '';?></textarea></p>
              <p><input type="button" name="add" value="Add/Update" class="btn btn-primary add">
            </form>
          </div>
          <div class="footBtn">
            <a href="plans-and-pricing.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
            <?php if (isset($discount_amount)) { ?>
              <a href="cartAction.php?action=placeOrder&coupon_discount=<?php echo $discount_amount; ?>" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
            <?php  } else { ?>
              <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
            <?php } ?>

          </div>
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

  <script>
    // Send otp 
    $('#add_gst').on('click', '.add', function() {
      //var userDataTable  = $('#allblogs').DataTable();
      // AJAX request
      var gst_no = $('#gst_no').val();
      var gst_address = $('#gst_address').val();
      //alert($member_id);
      if (gst_no == '') {
        alert('GST No not provided.')
        exit();
      }
      if (gst_address == '') {
        alert('Address not provided.')
        exit();
      }
      $.ajax({
        url: 'add_gst',
        type: 'POST',
        data: {
          gst_no: gst_no,
          gst_address: gst_address,
          id:<?php echo $member_id;?>
        },
        success: function(response) {
          if (response == "1") {
            alert("GST Details updated successfully.");
          } else {
            alert("Invalid input.");
          }
        }
      });

    });
  </script>
</body>

</html>