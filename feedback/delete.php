<?php 
include_once('config.php');

if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['sessCustomerID'])){
    if($_SESSION['sessCustomerID'] == "7"){

    }else{
      header("Location: ../profile.php");
      exit();
    }
  }else{
    header("Location: ../login.php");
    exit();
  }
  
  
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('users',array('id'=>$_REQUEST['delId']));
	header('location: track?msg=rds');
	exit;
}
?>