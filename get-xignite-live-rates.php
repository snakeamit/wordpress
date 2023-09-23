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
  $usd = '';
  if(isset($_POST['data'])){
    $k=0;
    #$curr = $_POST['data'];
    
    $sql = "SELECT `bid`,`ask`,`mid`, `spread` FROM `xignite-rates-ibr`";
    $result = $conn->query($sql);
    $usd = 0;

    if ($result->num_rows > 0) {
      $usd = 1;    
      while($row = $result->fetch_assoc()) {
        $usd =$usd.'-'.(string)$row["bid"].'-'.(string)$row["ask"].'-'.(string)$row["mid"].'-'.(string)$row["spread"];		
      }
    }else{
      print_r("Error");
    }
  }
 
  print_r($usd);
}
?>