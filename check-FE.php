<?php
if(session_id()=='' || !isset($_SESSION)){
    session_start();
}

$allow="NO";

if(isset($_SESSION['FEEXAM'])){
  if($_SESSION['FEEXAM'] == "AVAILABLE"){ 
    $allow="YES";
  }else{
    $allow="NO";
  }
}else{
 $allow="NO";
}

?>