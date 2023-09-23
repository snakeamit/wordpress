<?php
if(session_id()=='' || !isset($_SESSION)){
    session_start();
}

$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$custId = $_SESSION['sessCustomerID'];
$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$dateNow = $date->format('Y-m-d');

//$sqlfx = "SELECT * FROM `subscription` WHERE customer_id='$custId' AND status='AVAILABLE' AND expire_on >= '$dateNow' AND product_id='7' ";
$sqlfx = "SELECT * FROM `subscription` WHERE customer_id='$custId' AND status='AVAILABLE' AND expire_on >= '$dateNow'";
$resultfx = $conn->query($sqlfx);

$allowFC = "NO";

if ($resultfx->num_rows > 0) {
  $_SESSION['FXPRESS']="AVAILABLE";
  $allowFC="YES";
}else{
  $_SESSION['FXPRESS']="NOTAVAILABLE";
  $allowFC="NO";
}

$conn->close();
?>