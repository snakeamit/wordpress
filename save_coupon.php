<?php
//error_reporting(E_ALL);
include_once('lib/database.php');
	if(isset($_POST['coupon_code'])){
        //print_r($_POST);
        $conn = OpenCon();
        $coupon_code = mysqli_real_escape_string($conn, $_POST['coupon_code']);
		$discount = mysqli_real_escape_string($conn, $_POST['discount']);
        $multiple = mysqli_real_escape_string($conn, $_POST['multiple']);
        $validity = mysqli_real_escape_string($conn, $_POST['validity']);
		$status = "valid";
       // echo '<script>alert('.$validity.')</script>';die;
        //$conn = OpenCon();
		$query = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code'") or die(mysqli_error($conn));
		$row = mysqli_num_rows($query);
        //print_r($row);
		
		if($row > 0){
            echo 0;
            exit;
			// echo "<script>alert('Coupon Already Use')</script>";
			// echo "<script>window.location = '/all-coupons'</script>";
		}else{
			mysqli_query($conn, "INSERT INTO coupon (coupon_code, discount, multiple, validity, status) VALUES('$coupon_code', '$discount', '$multiple', '$validity','$status')") or die(mysqli_error($conn));
			// echo "<script>alert('Coupon Saved!')</script>";
			// echo "<script>window.location = '/all-coupons'</script>";
            echo 1;
            exit;
		}
	}
?>