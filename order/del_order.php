<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$orderId = $_POST['orderId'];

$con->query("DELETE FROM Orders WHERE orderId = '".$orderId."'");

$con->close();
?>
