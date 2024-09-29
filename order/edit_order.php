<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$orderId = $_POST['orderId'];
$amount = $_POST['amount'];

$con->query("UPDATE Orders SET amount = '".$amount."' WHERE orderId = '".$orderId."'");

$con->close();
?>
