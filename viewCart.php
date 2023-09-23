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
} else {
}
?>
<?php
// initializ shopping cart class
//include 'Cart.php';
//$cart = new Cart;
include('lib/database.php');
require_once 'lib/ShoppingCart.php';
$shoppingCart = new ShoppingCart();


if (isset($_POST['discountCode'])) {
  $con = OpenCon();
  $coupon_code = mysqli_real_escape_string($con, $_POST['discountCode']);
  //echo $coupon_code;die;
  // Set the INSERT SQL data
  $sql = "SELECT * FROM coupon WHERE coupon_code='" . $coupon_code . "' AND status='valid'";

  // Process the query
  $results = $con->query($sql);
  // print_r($results->num_rows);
  $err = '';
  if ($results->num_rows <= 0) {
    $err = 'Coupon is not valid or expired.';
  } else {
    // Fetch Associative array
    $row = $results->fetch_assoc();
  }

  //print_r($row);die;
  //Array ( [id] => 2 [coupon_code] => IBR2BUT0601 [discount] => 500 [status] => valid )
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Cart | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once('include/head.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    input[type="number"] {
      width: 20%;
    }

    hr.divider {
      max-width: 3.25rem;
      border-width: 0.2rem;
      border-color: #f4623a;
    }
  </style>
  <style>
    .table {
      width: 100%;
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

  </style>
  <style>
    .icon-input-btn {
      position: relative;
    }

    .icon-input-btn input[type="submit"] {
      padding-right: 2em;
    }

    .icon-input-btn .glyphicon-menu-right {
      float: right;
      margin-top: 24px;

    }

    .discount_block {
      display: block;
    }

    .discount_none {
      display: none;
    }
  </style>
  <script>
    function updateCartItem(obj, id) {
      $.get("cartAction.php", {
        action: "updateCartItem",
        id: id,
        qty: obj.value
      }, function(data) {
        if (data == 'ok') {
          location.reload();
        } else {
          alert('Cart update failed, please try again.');
        }
      });
    }
  </script>

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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">View Cart</h4>
      </div>
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th><strong>Name</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Action</strong></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tax = 18;
              //Convert our percentage value into a decimal.
              $percentInDecimal = $tax / 100;
              $member_id = $_SESSION['sessCustomerID'];
              $cartItem = $shoppingCart->getMemberCartItem($member_id);
              if (!empty($cartItem)) {
                $item_total = 0;
                //get cart items from session
                foreach ($cartItem as $item) {
              ?>

                  <tr>
                    <td><strong><?php echo $item["name"]; ?></strong></td>
                    <td><input type="text" maxlength="2" size="2" style='width: 50px; border-right:none;border-left:none;border-bottom:none;border-top:none' readonly class="form-control text-center" value="<?php echo $item["quantity"]; ?>"></td>
                    <td><?php echo "&#8377;" . $item["price"]; ?></td>
                    <td><a href="cartAction.php?action=removeCartItem&id=<?php echo $item["cart_id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete ?')"><i class="glyphicon glyphicon-trash"></i>Delete</a></td>
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
                <?php if (isset($row['discount'])) {
                  $coupon_discount = $row['discount'] / 100;
                  $discount_amount = $item_total * $coupon_discount;

                  $finalTax = $percentInDecimal * ($item_total - $discount_amount);
                  $item_total  = $item_total - $discount_amount;
                ?>
                  <tr>
                    <td colspan="2" align=right><strong>Discount:</strong></td>
                    <td align=left style="color:#f4623a"><?php echo "&#8377;" . $discount_amount; ?></td>
                    <td><a href="">Remove</a></td>
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
              <?php
                $disclass = 'discount_block';
              } else {
                $disclass = 'discount_none';
              ?>
                <tr>
                  <td colspan="5">
                    <p>Your cart is empty...</p>
                  </td>
                <?php }
                ?>
            </tbody>

          </table>


          <div style="float:right;" class="<?php echo $disclass; ?>">
            <form action="" method="post" class="row g-3">
              <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden"></label>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Coupon Code: ">
              </div>
              <div class="col-auto">
                <input type="text" class="form-control discount-code" id="discountCode" name="discountCode" size="15" placeholder="Enter Coupon Code" />
              </div>
              <div class="col-auto">
                <input id="btnDiscountAction" type="submit" value="Apply Discount" class=" btn btn-primary btnDiscountAction" />
              </div>
            </form>
            <p><?php if (isset($err)) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $err; ?>
            </div>

          <?php } ?>
          </p>
          </div>

          <div class="footBtn">
            <?php if (isset($cartItem) && count($cartItem) > 0) { ?>
              <?php if (isset($row['discount'])) { ?>
                <!-- <form action="/checkout.php" method="post"> -->
                <a href="checkout.php?discount=<?php echo $row['discount']; ?>" class="btn btn-success" style="float:right">Checkout <i class="glyphicon glyphicon-menu-right"></i></a>
                <!-- </form> -->
              <?php } else { ?>
                <a href="checkout.php" class="btn btn-success" style="float:right">Checkout <i class="glyphicon glyphicon-menu-right"></i></a>
              <?php } ?>
            <?php } ?>
            <a href="plans-and-pricing.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>

          </div>

          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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
</body>

</html>