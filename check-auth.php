<?php
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
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
    if($allow=="YES"){
      header("Location: our-products.php"); 
      exit();
    }else{
      header("Location: our-products.php"); 
      exit();
    }
  }
?>