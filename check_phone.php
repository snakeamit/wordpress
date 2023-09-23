<?php  
include('lib/database.php');
//check.php  
$connect = OpenCon();
if(isset($_POST["phone"]))
{
 $username = mysqli_real_escape_string($connect, $_POST["phone"]);
 $query = "SELECT * FROM customers WHERE phone = $username";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}
?>