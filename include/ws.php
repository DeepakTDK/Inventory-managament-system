<?php

session_start();
error_reporting(0);

$mysqli = new mysqli('localhost', 'root', '', 'ims') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$wid = '';
$wname = '';
$wnumber = '';
$waddress = '';

//insert 
if(isset($_POST['save'])){
    $wid = $_POST['wid'];
    $wname = $_POST['wname'];
    $wnumber = $_POST['wnumber'];   
    $waddress= $_POST['waddress'];

    $mysqli->query("INSERT INTO  wholesaler (w_id, w_name, w_number, w_address) VALUES ('$wid', '$wname', '$wnumber', '$waddress')") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record saved!" ;
    $_SESSION['msg_type'] = "success" ;

    header("location: ../dist/wholesaler.php");
}

//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE from wholesaler WHERE w_id = $id") or die($mysqli->error());

    $_SESSION['message'] = "Record deleted!" ;
    $_SESSION['msg_type'] = "danger" ;

    header("location: ../dist/wholesaler.php");
}

//edit
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from wholesaler WHERE w_id = $id") or die($mysqli->error());
    if(count($result) == 1){
        $row = $result->fetch_array();
        $wid = $row['w_id'];
        $wname = $row['w_name'];
        $wnumber = $row['w_number'];   
        $waddress= $row['w_address'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $wid = $_POST['wid'];
    $wname = $_POST['wname'];
    $wnumber = $_POST['wnumber'];   
    $waddress= $_POST['waddress'];

    $mysqli->query("UPDATE wholesaler SET w_id = '$wid', w_name = '$wname', w_number = '$wnumber', w_address = '$waddress' WHERE w_id = $id") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: ../dist/wholesaler.php");
}

?>