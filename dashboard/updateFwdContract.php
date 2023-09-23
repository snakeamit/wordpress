<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  
  if(isset($_POST['addFwdContract'])){
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }  
    
    $uid = $_SESSION['userid'];
    $uemail = $_SESSION['useremail'];
    
    $pair = $_POST['fpair']; 
    $amount = $_POST['famount']; 
    $ctype = $_POST['fctype']; 
    $cno = $_POST['fcno'];
    $crate = $_POST['fcrate'];
    $fdate = $_POST['ffdate'];
    $tdate = $_POST['ftodate'];
    $bdate = $_POST['fbookdate'];
    $utilized = 0;
    $bank = $_POST['fbank'];
    $ddfrom = $_POST['fddfrom'];
    $ddto = $_POST['fddto'];
    $spot = $_POST['fspot'];

    $bdate = date("Y-m-d",strtotime($bdate));
    $fdate = date("Y-m-d",strtotime($fdate));
    $tdate = date("Y-m-d",strtotime($tdate));
    $ddfrom = date("Y-m-d",strtotime($ddfrom));
    $ddto = date("Y-m-d",strtotime($ddto));
    if($ddfrom == "1970-01-01"){
      $ddfrom = "0000-00-00";    
     
    }
    
    if($ddto == "1970-01-01"){
      $ddto = "0000-00-00";
     }
    
    if($fdate > $tdate){
      $errorFwdInfo = "From-date cannot be greater than to-date";
      echo "<script>alert('From-date cannot be greater than to-date')</script>";
    }else if($ddfrom > $ddto){
      $errorFwdInfo = "From-date cannot be greater than to-date";
      echo "<script>alert('From-date cannot be greater than to-date')</script>";
    }
    else{
      $sql = "INSERT INTO fwdContract (pair, amount, type, cnumber, crate, cfrom, cto, userID, cbook, utilized, bank, ddfrom, ddto, spot) VALUES ('$pair', '$amount', '$ctype', '$cno', '$crate', '$fdate', '$tdate', '$uid', '$bdate', '$utilized', '$bank', '$ddfrom', '$ddto', '$spot')";

      if ($conn->query($sql) === TRUE) {
	
        $successFwdInfo = "Data added successfully!";
      } else {
	echo $conn->error;
    	$errorFwdInfo = "Error: ";
      }
    }
     
    $conn->close();
    
    unset($_POST);
    $_POST = array();
    
    echo "<meta http-equiv='refresh' content='0'>";
  }
  
?>
