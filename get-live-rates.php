<?php
include_once('lib/database.php');
if(isset($_POST)){
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";

  $conn = OpenCon();
  //Create connection
  //$conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }   
  $usd = '';
  if(isset($_POST['data'])){
    $k=0;
    #$curr = $_POST['data'];
    
    $sql = "SELECT `rate`,`bid`,`ask`,`high`,`low`,`open`,`close`,`timestamp` FROM `live-rates-ibr`";
    $result = $conn->query($sql);
    $usd = 0;

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $usd =$usd.'-'.(string)$row["rate"].'-'.(string)$row["bid"].'-'.(string)$row["ask"].'-'.(string)$row["high"].'-'.(string)$row["low"].'-'.(string)$row["open"].'-'.(string)$row["close"].'-'.(string)$row["timestamp"];		
      }
    }else{
      print_r("Error");
    }
  }
 
  print_r($usd);
}
?>