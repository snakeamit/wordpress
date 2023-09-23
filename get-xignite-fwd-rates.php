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
  $usdFwd = '';
  if(isset($_POST['data'])){
    $k=0;
    #$curr = $_POST['data'];
    
    $sql = "SELECT `points`,`spotrate`,`ask`, `mid`, `bid`, `expiration` FROM `xignite-fwd-ibr`";
    $result = $conn->query($sql);
    $usdFwd = 0;

    if ($result->num_rows > 0) {
      $usdFwd = 1;    
      while($row = $result->fetch_assoc()) {
        $usdFwd =$usdFwd.'-'.(string)$row["points"].'-'.(string)$row["spotrate"].'-'.(string)$row["ask"].'-'.(string)$row["mid"].'-'.(string)$row["bid"].'-'.(string)$row["expiration"];		
      }
    }else{
      print_r("Error");
    }
  }
 
  print_r($usdFwd);
}
?>