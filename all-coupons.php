<?php
error_reporting(E_ALL);
include_once('lib/database.php');
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7"){

    }else{
      header("Location: profile.php");
      exit();
    }
  }else{
    header("Location: login.php");
    exit();
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
    if($allow==""){
      
    }else{
      
    }
  }
?>



<?php
  $conn = OpenCon();
  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  }else{
    $succ = "Connection established";
  }
  $sql = "SELECT * FROM coupon ORDER BY id DESC";
  $result = mysqli_query($conn, $sql);
  $conn->close();
?>    

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
  <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

  <title>All Coupons | IBR Live</title>

  <?php include_once('include/head.php'); ?>
  <!-- Include stylesheet -->
  <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
  <meta name="theme-color" content="#ffffff">

</head>
<body>

<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <?php include_once('include/top-menu.php'); ?>

    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">All Coupons</h4>
      </div>
    </div>
  </div>

  <?php //echo $statusMsg; ?>
  <div class="row" style="padding-top: 135px;">
        <div class="col-md-2">
        <div class="list-group" id="leftnav" style="padding-left: 15px;">					
		    <a id="t-3" href="/profile" class="list-group-item"><i class="fa fa-home"></i> <strong> Dashboard</strong></a>
            <a id="t-4" href="/create-blogs" class="list-group-item"><i class="fa fa-book"></i> <strong> Create Blogs</strong></a>
            <a id="t-4" href="/all-blogs" class="list-group-item"><i class="fa fa-newspaper-o"></i> <strong> All Blogs</strong></a>
            <a id="t-4" href="/all-coupons" class="list-group-item"><i class="fa fa-tags"></i> <strong> Coupons</strong></a>
            <a id="t-4" href="/transactions" class="list-group-item"><i class="fa fa-tasks"></i> <strong> Transactions</strong></a>		
        </div>
        </div>     
        <div class="col-md-8">
        <p> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_coupon"><span class="glyphicon glyphicon-plus"></span> Generate Coupon</button></p>  
        <table class="table table-hover" id="allblogs">
        <thead>
            <tr>
                <th>ID</th>
                <th>Coupon Code</th>
                <th>Discount(%)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
            <?php
                while($row = $result->fetch_assoc()){
                    echo '<tr>';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['coupon_code'].'</td>';
                    echo '<td>'.$row['discount'].'</td>';
                    echo '<td>'.$row['status'].'</td>';
            ?>

                    <td>
                        <!-- <button class="editbtn btn btn-info" > <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <a href="editblog.php?id=<?php echo $row['id'];?>" >Edit </a > </button > -->
                        <button class="delbtn btn btn-danger btn-sm deleteBlog" data-id="<?php echo $row['id']?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete </button >
                    </td>
                    
            <?php 
                    echo '</tr>';

                }
            ?>
        </table>
        </div>
    <div class="col-md-2" ></div>
	
</div><!--/Left Column-->
<br/><br/>

  <div class="modal fade" id="form_coupon" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<form action="" method="post" id="generate_form">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Coupon Code</label>
								<input type="text" class="form-control px-4" name="coupon" id="coupon_code" readonly="readonly" required="required"/>
								<br />
								<button id="generate" class="btn btn-success" type="button"><span class="glyphicon glyphicon-random"></span> Generate</button>
							</div>
							<div class="form-group">
								<label>Discount(%)</label>
								<input type="text" class="form-control px-4" name="discount" id="discount" required="required"/>
							</div>
              <div class="form-group">
								<label>Multi User</label>
								<select name="multiuser" id="multiuser" required class="selectpicker show-tick">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
							</div>
              <div class="form-group">
								<label>Validity in days</label>
								<input type="text" class="form-control" name="validity" id="validity" required="required"/>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button class="btn btn-primary save"><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>

  <?php require 'include/footer.php'; ?>


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function () {
        var blogDataTable  = $('#allblogs').DataTable({
            'processing': true,
        });

          // Delete record
            $('#allblogs').on('click','.deleteBlog',function(){
                var id = $(this).data('id');
                //var userDataTable  = $('#allblogs').DataTable();
                var deleteConfirm = confirm("Are you sure you want to delete this coupon ?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                    url: 'delete-coupon',
                    type: 'GET',
                    data: {deleteId: id},
                    success: function(response){
                        if(response == 1){
                            alert("Coupon was deleted successfully");
                            location.reload();
                        }else{
                            alert("Invalid ID.");
                        }
                    }
                    });
                } 

            });

    });

    function refresh_tab(){
        $('#allblogs').DataTable().ajax.reload();
    }
</script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function(){
		$('#generate').on('click', function(){
			$.get("get_coupon", function(data){
				$('#coupon_code').val(data);
			});
		});
	});


// Delete record
$('#generate_form').on('click','.save',function(){
          // AJAX request
      var coupon_code = $('#coupon_code').val();
      var discount = $('#discount').val();
      var multiple = $('#multiuser').val();
      var validity = $('#validity').val();
      if(coupon_code == '') {
        alert('Coupon code not provided.')
        exit();
      }
      if(discount =='') {
        alert('discount not provided.')
        exit();
      }
        // AJAX request
        $.ajax({
        url: 'save_coupon',
        type: 'POST',
        data: {coupon_code: coupon_code, discount: discount, multiple: multiple, validity: validity},
        success: function(response){
            if(response == 1){
                alert("Coupon was generated successfully");
                location.reload();
            }else{
                alert("Invalid ID.");
                location.reload();
            }
        }
        });

});
</script>


</body>
</html>