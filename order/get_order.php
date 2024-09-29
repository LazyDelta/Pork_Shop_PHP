<?php
include './../connect.php';

if (!$con) {
    echo "connection error";
}

// use in cart_screen

$userId = $_POST['userId'];

// Adjust SQL query to ensure it only selects orders that are not in orderdetail for the given userId
$queryResult = $con->query("
  SELECT Orders.orderId, product.productName, Orders.amount, product.price
  FROM Orders 
  JOIN product ON Orders.productId = product.productId
  LEFT JOIN orderdetail ON Orders.orderId = orderdetail.orderId
  WHERE Orders.userId = '".$userId."' AND orderdetail.orderId IS NULL
");

$result = array();

while ($fetchData = $queryResult->fetch_assoc()) {
    $result[] = $fetchData;
}

echo json_encode($result);

$con->close();
?>
