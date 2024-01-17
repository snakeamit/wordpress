<?php
session_start();
include_once('lib/database.php');

if (isset($_POST['gst_no'])) {

    $gst_no = $_POST['gst_no'];
    $gst_address = $_POST['gst_address'];
    $id = $_POST['id'];
    update_data($gst_no, $gst_address, $id);
}

// delete data query
function update_data($gst_no, $gst_address, $id)
{
    //$id = $_SESSION['sessCustomerID'];
    $conn = OpenCon();

    //echo "Update customers SET gst_no='$gst_no' , gst_address='$gst_address' WHERE id=$id";
    $insert = $conn->query("Update customers SET gst_no='$gst_no' , gst_address='$gst_address' WHERE id=$id");
    //print_r($insert);
    if ($insert) {
        echo 1;
        exit;
    } else {
        echo 0;
        exit;
    }

//     $query = "Update customers SET gst_no=$gst_no , gst_address=$gst_address WHERE id=$id";
//     $exec = mysqli_query($connection, $query);

//     if ($exec) {
//         echo 1;
//         exit;
//     } else {
//         echo 0;
//         exit;
//     }
// 
}