<?php
if(session_id()=='' || !isset($_SESSION)){
    session_start();
}

if(isset($_POST['coupon'])){
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

  $code = $_POST['code'];
  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
  $dateNow = $date->format('Y-m-d');
  
  $sqlc = "SELECT * FROM `couponFxpress` WHERE code='$code' AND end >= '$dateNow' ";
  $resultc = $conn->query($sqlc);

  $discount = (float)0;

  if ($resultc->num_rows > 0) {
    while($rowc = $resultc->fetch_assoc()) {  
      $discount = (float) $rowx['discount'];
    }
  }else{
    $discount = (float)0;
  }

}
?>