<?php
include_once('lib/database.php');
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['sessCustomerID'])) {
  if ($_SESSION['sessCustomerID'] == "7") {
  } else {
    header("Location: profile.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
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
  if ($allow == "") {
  } else {
  }
}
?>

<?php
if (isset($_SESSION['useremail'])) {
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";

  //Create connection
  $conn = OpenCon();
  //$conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $error = "";
  $success = "";

  $hash = "";
  $allow = "";

  $name = "";
  $paid = "";
  $created = "";
  $validity = "";
  $amount = "";
  $member = "";
  $phone = "";

  $email = $_SESSION['useremail'];

  if ($error == "") {
    $sql = "SELECT id, name, member, phone, paid, created, validity, amount, password FROM customers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hash = $row['password'];
        $_SESSION['userallow'] = $row['paid'];
        $_SESSION['username'] = $row['name'];
        $name = $row['name'];
        $paid = $row['paid'];
        $created = $row['created'];
        $validity = $row['validity'];
        $amount = $row['amount'];
        //$member = $row['member'];
        $phone = $row['phone'];
      }
    } else {
      $error = "Invalid Email or Password";
    }
    //$conn->close();   
  }

  if ($hash == "") {
    $error = "Invalid Email or Password";
  } else {
    if (!empty($_POST["passworduser"])) {
      $auth = password_verify($_POST['passworduser'], $hash);
      if ($auth == 1) {
        $allow;
        $success = "Authentication successful";
        header('Location: welcome.php');
        exit();
      } else {
        $error = "Invalid Email or Password";
      }
    }
  }

  if (!isset($_SESSION['member'])) {
    $custId = $_SESSION['sessCustomerID'];

    $sql2 = "SELECT product_id FROM `subscription` WHERE `status`='AVAILABLE' AND `customer_id`='$custId' ORDER BY product_id DESC";

    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {

      $maxid = 0;
      while ($row2 = $result2->fetch_assoc()) {
        if ($row2['product_id'] == "6" || $row2['product_id'] == "3") {
          $maxid = 6;
        }

        if ($row2['product_id'] == "5" || $row2['product_id'] == "2") {
          if ($maxid >= 6) {
          } else {
            $maxid = 5;
          }
        }

        if ($row2['product_id'] == "4" || $row2['product_id'] == "1") {
          if ($maxid >= 5) {
          } else {
            $maxid = 4;
          }
        }

        if ($row2['product_id'] == "7") $maxid = 6;
      }

      switch ($maxid) {
        case "1":
          $member = "Standard";
          break;

        case "2":
          $member = "Gold";
          break;

        case "3":
          $member = "Platinum";
          break;

        case "4":
          $member = "Standard";
          break;

        case "5":
          $member = "Gold";
          break;

        case "6":
          $member = "Platinum";
          break;

        default:
          $member = "Normal";
      }

      $_SESSION['member'] = $member;
    } else {
      $member = "Normal";
      $_SESSION['member'] = "Normal";
    }
  } else {
    $member = $_SESSION['member'];
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Profile | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php include_once('include/head.php'); ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
    function trackTransaction(idd) {
      $.post('track-transaction', {
        oid: idd
      }, function(response) {
        document.getElementById('orderpaystatus').innerHTML = response;

        $('#modal-transaction').modal('show');
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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Special Admin Page at IBR Live!</h4>
      </div>
    </div>
  </div>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">

    <!-- Content Wrapper. Contains page content -->
    <div class="modal fade" id="modal-transaction">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Payment Status!</h4>
          </div>
          <div class="modal-body" id="orderpaystatus">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="row" style="margin-top: 30px;">
      <!-- /.col -->

      <div class="col-md-6">
        <div class="box" style="height: 600px;">
          <div class="box-header" >
            <h3 class="box-title "><u>All Products</u></h3>

            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="pdetails" class="table table-hover display nowrap" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <!-- <th>Description</th> -->
                  <th>Price</th>
                  <th>Duration (Days)</th>
                </tr>
              </thead>

              <?php
              //Create connection
              $conn = OpenCon();
              //$conn = new mysqli($servername, $username, $password, $dbname);

              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $custId = $_SESSION['sessCustomerID'];
              $query = "SELECT * FROM products";
              $result2 = $conn->query($query);

              $pname = "";
              while ($row2 = $result2->fetch_assoc()) {
                echo "<tr><td></td><td>" . $row2['name'] . "</td><td>&#8377; " . $row2['price'] . "</td><td>" . $row2['duration'] . "</td></tr>";

                #echo "<tr><td>" . $row2['name'] . "</td><td>" . $row2['description'] . "</td><td>&#8377; " . $row2['price'] . "</td><td>" . $row2['duration'] . "</td></tr>";
              }
              ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <!-- <th>Description</th> -->
                  <th>Price</th>
                  <th>Duration (Days)</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-6">
        <div class="box" style="height: 600px; overflow-y: scroll;">
          <div class="box-header">
            <h3 class="box-title"><u>Customer's Detail</u></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="cdetails" class="table table-hover display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Profession</th>
                  <th>Phone No.</th>
                  <th>OTP</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $custId = $_SESSION['sessCustomerID'];
                $query = "SELECT * FROM customers ORDER BY id DESC";
                $result2 = $conn->query($query);

                $pname = "";
                while ($row2 = $result2->fetch_assoc()) {
                  echo "<tr><td></td><td>"
                    . $row2['name'] . "</td><td>" . $row2['email'] . "</td><td>"
                    . $row2['interest'] . "</td><td>" . $row2['phone'] . "</td><td>" . $row2['otp'] . "</td></tr>";
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Profession</th>
                  <th>Phone No.</th>
                  <th>OTP</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

    </div>
    <div class="row" style="margin-top: 50px;">
      <div class="col-md-12">
        <div class="box" style="height: 600px; overflow-y: scroll;">
          <div class="box-header">
            <h3 class="box-title"><u>Customer's Purchase(s) (Only Successful Transactions)</u></h3>

            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="cpdetails" class="table table-hover display nowrap" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Order No</th>
                  <th>Amount Paid</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Customer Phone</th>
                  <th>Product Name</th>
                  <th>Paid On</th>
                  <th>Valid Until</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php

                //$custId= $_SESSION['sessCustomerID'];
                $query3 = "SELECT DISTINCT  subscription.order_id AS order_id, orders.total_price AS amount, customers.name AS customer_name, customers.email AS customer_email, customers.phone AS customer_phone, products.name AS products_name, subscription.paid_on AS paid_on, subscription.expire_on AS expire_on, subscription.status AS sub_status from customers, subscription, products, orders WHERE subscription.customer_id=customers.id AND subscription.product_id=products.id AND orders.id=subscription.order_id ORDER BY subscription.order_id DESC";

                $result3 = $conn->query($query3);
                while ($row3 = $result3->fetch_assoc()) {
                  //if($pname!="")
                  echo "<tr><td></td><td>" . $row3['order_id'] . "</td><td>&#8377; " . $row3['amount'] . "</td><td>" . $row3['customer_name'] . "</td><td>" . $row3['customer_email'] . "</td><td>" . $row3['customer_phone'] . "</td><td>" . $row3['products_name'] . "</td><td>" . date("d-m-Y", strtotime($row3['paid_on'])) . "</td><td>" . date("d-m-Y", strtotime($row3['expire_on'])) . "</td><td>" . $row3['sub_status'] . "</td></tr>";
                  //} 
                }

                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Order No</th>
                  <th>Amount Paid</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Customer Phone</th>
                  <th>Product Name</th>
                  <th>Paid On</th>
                  <th>Valid Until</th>
                  <th>Status</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <div class="row" style="margin-top: 50px;">
      <div class="col-md-12">
        <div class="box" style="height: 600px; overflow-y: scroll;">
          <div class="box-header">
            <h3 class="box-title"><u>All orders (Including Failed orders also)</u></h3>

            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="apdetails" class="table table-hover display nowrap" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Order No</th>
                  <th>Customer Name</th>
                  <th>Amount Paid/To be Paid</th>
                  <th>Order Date</th>
                  <th>Check Status</th>
                </tr>
              </thead>
              <tbody>
                <?php

                //$custId= $_SESSION['sessCustomerID'];
                $query4 = "SELECT ord.id AS ordid, ord.customer_id AS ordcustid, ord.total_price AS ordamt, ord.created AS orddate, cust.id AS custid, cust.name AS custname from orders ord, customers cust WHERE ord.customer_id=cust.id AND cust.id!=7 AND cust.id!=3 ORDER BY ord.id DESC";

                $result4 = $conn->query($query4);
                while ($row4 = $result4->fetch_assoc()) {
                ?>
                  <tr>
                    <td></td>
                    <td><?php echo $row4['ordid']; ?>
                    </td>
                    <td><?php echo $row4['custname']; ?>
                    </td>
                    <td>&#8377; <?php echo $row4['ordamt']; ?> </td>
                    <td> <?php echo date("d-m-Y", strtotime($row4['orddate'])); ?></td>
                    <td><a href="javascript:void(0);" onClick="trackTransaction(<?php echo htmlentities($row4['ordid']); ?>)" title="See Payment Status"> Payment Status</a></td>
                  </tr>
                <?php
                }

                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Order No</th>
                  <th>Customer Name</th>
                  <th>Amount Paid/To be Paid</th>
                  <th>Order Date</th>
                  <th>Check Status</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <div class="row" style="margin-top: 50px;">
      <div class="col-md-12">
        <div class="box" style="height: 600px; overflow-y: scroll;">
          <div class="box-header">
            <h3 class="box-title"><u>User Login Information (Last 50 User Login)</u></h3>

            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="ldetails" class="table table-hover display nowrap" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>User Email</th>
                  <th>User IP</th>
                  <th>Login Time</th>
                  <th>Logout Time</th>
                </tr>
              </thead>
              <tbody>
                <?php

                //$custId= $_SESSION['sessCustomerID'];
                $query5 = "SELECT * from userlog WHERE userEmail != 'admin@ibrlive.com' and userEmail != 'test@ibrlive.com' and userEmail != 'pawan01dec@hotmail.com' ORDER By id DESC LIMIT 50";

                $result5 = $conn->query($query5);
                #$cnt=1;
                while ($row5 = $result5->fetch_assoc()) {
                ?>
                  <tr>
                    <td></td>
                    <td><?php echo $row5['userEmail']; ?>
                    </td>
                    <td><?php echo $row5['userip']; ?>
                    </td>
                    <td><?php echo $row5['loginTime']; ?>
                    </td>
                    <td><?php echo $row5['logout']; ?>
                    </td>
                  </tr>
                <?php
                  #$cnt=$cnt+1;
                }

                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>User Email</th>
                  <th>User IP</th>
                  <th>Login Time</th>
                  <th>Logout Time</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
  <?php include_once("include/footer.php"); ?>
  <!-- jQuery 3 -->
  <!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      var cds = $('#cdetails').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],

      });

      cds.on('order.dt search.dt', function() {
        cds.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();

      var pds = $('#pdetails').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],

      });

      pds.on('order.dt search.dt', function() {
        pds.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();

      var cpds = $('#cpdetails').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],

      });

      cpds.on('order.dt search.dt', function() {
        cpds.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();

      var apds = $('#apdetails').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],

      });

      apds.on('order.dt search.dt', function() {
        apds.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();


      var lds = $('#ldetails').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],

      });

      lds.on('order.dt search.dt', function() {
        lds.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();


    });
  </script>
</body>

</html>