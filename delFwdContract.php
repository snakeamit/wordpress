<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";

  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }
  
  if(isset($_POST['rowid'])){
     
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }  
    
    $uid = $_SESSION['sessCustomerID'];
    $uemail = $_SESSION['useremail'];
    
    $rowdel = $_POST['rowid']; 

    $sql = "DELETE from fwdContract WHERE id='$rowdel' AND userID='$uid' ";

    if ($conn->query($sql) === TRUE) {
      echo "Data deleted successfully!";
    } else {
      echo "Error: Try Later!";
    }
    
    $conn->close();
    
  }
  

?>
