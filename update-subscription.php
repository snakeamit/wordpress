<?php
if(isset($_POST)){
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
  $oid = '';
  $dateExpiry = '';
  $sts = '';
  
  $resp = 'Success';
  
  if(isset($_POST['oid'])){
    $oid = $_POST['oid'];
    $dateExpiry = $_POST['dt'];
    $sts = $_POST['sts'];
  
   $sql="UPDATE subscription SET expire_on='$dateExpiry', status='$sts' WHERE order_id='$oid' ";
    
    if ($conn->query($sql) === TRUE) {
      $resp = "Record updated successfully";
    } else {
      $resp = "Error updating record: " . $conn->error;
    }        
  }
    
  $conn->close();
  print_r($resp);
}
?>