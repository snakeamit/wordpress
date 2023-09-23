<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";

  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }
  
  if(isset($_POST['rowid'])){
    $utl = $_POST['utilized']; 
    
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }  
    
    $uid = $_SESSION['sessCustomerID'];
    $uemail = $_SESSION['useremail'];
    
    $rowupd = $_POST['rowid']; 

    $val = mysqli_query($conn,"update fwdContract set utilized='$utl' WHERE id='$rowupd' AND userID='$uid' ");
    
    if ($val) {
      echo "Data Updated successfully!";
    } else {
      echo "Error: Try Later!";
    }
    
    $conn->close();
    
  }
  

?>
