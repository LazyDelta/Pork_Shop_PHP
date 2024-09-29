<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$productId = $_POST['productId'];
$amount = $_POST['amount'];
$userId = $_POST['userId'];

// Insert order into the database
$con->query("INSERT INTO `Orders` (productId, amount, userId) VALUES ('".$productId."', '".$amount."', '".$userId."')");

$con->close();
?>
