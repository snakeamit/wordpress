<?php  
  if(isset($_POST['nameuser'])){
    print_r($_POST);
    unset($_POST['nameuser']);
  }else{
    echo "Error";
    unset($_POST['nameuser']);
  }

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

  print_r($_POST);
  $result = mysqli_query($conn, "SELECT * FROM customers ORDER BY id DESC LIMIT 1");
  $row = mysqli_fetch_array($result);
  $idmax=$row['id'];

  $idmax = $idmax + 1;

  if($_POST['nameuser'])
    $nameuser = $_POST['nameuser'];
  else
    $nameuser = "";

  if($_POST['emailuser'])
    $emailuser = $_POST['emailuser'];
  else
    $emailuser = "";

  if($_POST['phoneuser'])
    $phoneuser = $_POST['phoneuser'];
  else
    $phoneuser = "";

  if($_POST['passworduser'])
    $passuser = $_POST['passworduser'];
  else
    $passuser = "";

  $sql = "INSERT INTO customers (id, name, email, phone, password) VALUES ('$idmax', '$name', '$email', '$phone', '$passuser')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } 
}

?>

<html>

<body>
<p>HERE</p>
<p><?php echo $nameuser;?></p>
<p><?php echo $emailuser;?></p>
<p><?php echo $phoneuser;?></p>
<p><?php echo $passuser;?></p>
<p><?php echo $idmax;?></p>
</body>

</html>