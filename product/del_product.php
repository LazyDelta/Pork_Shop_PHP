<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$productId = $_POST['productId'];
$con->query("DELETE FROM product WHERE productId = '".$productId."'");

$con->close();
?>
