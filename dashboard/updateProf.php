<?php
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  
  if(isset($_POST['updateProf'])){
    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }  
    
    $uid = $_SESSION['userid'];
    $uname = $_POST['uname']; 
    $uemail = $_POST['uemail']; 
    $uphone = $_POST['uphone']; 

    $res = mysqli_query($conn,"update customers set name='$uname', phone='$uphone' WHERE email='$uemail' and id='$uid' ");
   
    if($res){
      $successProf="Updation Successful!";
      $_SESSION['username'] = $uname;
      $_SESSION['userphone'] = $uphone;
    }else{
      $errorProf="Try later, please!";
    }
  }

?>
