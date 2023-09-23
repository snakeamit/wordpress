<?php
if(session_id()=='' || !isset($_SESSION)){
    session_start();
}

$allow="NO";

if(isset($_SESSION['MFEXAM'])){
  if($_SESSION['MFEXAM'] == "AVAILABLE"){ 
    $allow="YES";
  }else{
    $allow="NO";
  }
}else{
 $allow="NO";
}

?>