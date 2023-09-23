<?php
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7"){

    }else{
      header("Location: profile.php");
      exit();
    }
  }else{
    header("Location: login.php");
    exit();
  }

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];    
    $allow = $_SESSION['userallow']; 
  }else{
    $user="";
    $allow="";
  }

  if($user==""){
    header("Location: login.php"); 
    exit();
  }else{
    if($allow==""){
      
    }else{
      
    }
  }
  $servername = "localhost";
  $username = "ibrlive";
  $password = "tubelight";
  $dbname = "ibrMock";
  $succ = "";
  $err = "";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  }else{
    $succ = "Connection established";
  }

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, (int) $_GET['id']);
    $sql = "DELETE FROM blogs WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location: create-blogs.php');
    } else {
        echo "Failed to delete." . mysqli_connect_error();
    }
}
mysqli_close($conn);