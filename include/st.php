<?php

session_start();
error_reporting(0);

$mysqli = new mysqli('localhost', 'root', '', 'ims') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$pid = '';
$pname = '';
$price = '';
$quantity = '';
$wname = '';
$midate = '';
$expdate = '';

//insert 
if(isset($_POST['save'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];   
    $wname = $_POST['wname'];
    $midate = $_POST['midate'];
    $expdate = $_POST['expdate'];

    $mysqli->query("INSERT INTO  stocks (p_id, p_name, price, quantity, w_name, movedin_date, expiry_date) VALUES ('$pid', '$pname', '$price', '$quantity', '$wname', '$midate', '$expdate')") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record saved!" ;
    $_SESSION['msg_type'] = "success" ;

    header("location: ../dist/stocks.php");
}

//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE from stocks WHERE p_id = $id") or die($mysqli->error());

    $_SESSION['message'] = "Record deleted!" ;
    $_SESSION['msg_type'] = "danger" ;

    header("location: ../dist/stocks.php");
}

//edit
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from stocks WHERE p_id = $id") or die($mysqli->error());
    if(count($result) == 1){
        $row = $result->fetch_array();
        $pid = $row['p_id'];
        $pname = $row['p_name'];
        $price = $row['price'];
        $quantity = $row['quantity'];   
        $wname = $row['w_name'];
        $midate = $row['movedin_date'];
        $expdate = $row['expiry_date'];  
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];   
    $wname = $_POST['wname'];
    $midate = $_POST['midate'];
    $expdate = $_POST['expdate'];

    $mysqli->query("UPDATE stocks SET p_id = '$pid', p_name = '$pname', price = '$price', quantity = '$quantity', w_name = '$wname', movedin_date = '$midate', expiry_date = '$expdate' WHERE p_id = $id") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: ../dist/stocks.php");
}

?>