<?php

include_once('lib/database.php');

if(isset($_GET['deleteId'])){

    $id= $_GET['deleteId'];
    $connection = OpenCon();
    delete_data($connection, $id);

}

// delete data query
function delete_data($connection, $id){
   
    $query="DELETE from coupon WHERE id=$id";
    $exec= mysqli_query($connection,$query);

    if($exec){
      echo 1;
      exit;
    }else{
      echo 0;
      exit;
    }
}
?>