<?php  
include('lib/database.php');
//check.php  
$connect = OpenCon();
if(isset($_POST["email"]))
{
 $username = mysqli_real_escape_string($connect, $_POST["email"]);
 $query = "SELECT * FROM customers WHERE email = '".$username."'";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0) {
    echo 1;
 } else {
    echo 0;
 }
}
?>