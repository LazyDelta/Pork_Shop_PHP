<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$userId = $_POST['userId'];

// Select the total price from the Orders table excluding those in orderdetail
$result = $con->query("
  SELECT SUM(product.price * Orders.amount) AS totalPrice
  FROM Orders
  JOIN product ON Orders.productId = product.productId
  LEFT JOIN orderdetail ON Orders.orderId = orderdetail.orderId
  WHERE Orders.userId = '".$userId."' AND orderdetail.orderId IS NULL
");

$row = $result->fetch_assoc();
$totalPrice = $row['totalPrice'] ?? 0;

echo $totalPrice;

$con->close();
?>
