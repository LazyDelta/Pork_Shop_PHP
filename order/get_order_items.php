<?php
include './../connect.php';

header('Content-Type: application/json'); // Ensure that the response is always JSON

if (!$con) {
    echo json_encode(['error' => 'Connection failed: ' . mysqli_connect_error()]);
    exit;
}

$orderGroupId = isset($_POST['order_group_id']) ? $_POST['order_group_id'] : null;

if (!$orderGroupId) {
    echo json_encode(['error' => 'order_group_id is missing']);
    exit;
}

// Debugging: log the received order_group_id
error_log("Received order_group_id: " . $orderGroupId);

// Query to get product name, amount, and total price based on order_group_id
$query = "
  SELECT product.productName, orders.amount, (product.price * orders.amount) AS total_price, userdata.username
  FROM orderdetail
  JOIN orders ON orders.orderId = orderdetail.orderId
  JOIN product ON orders.productId = product.productId
  JOIN userdata ON orders.userId = userdata.userId
  WHERE orderdetail.order_group_id = '".$orderGroupId."';
";


// Log the query for debugging
error_log("Executed query: " . $query);

$result = $con->query($query);

if (!$result) {
    // Log the error and return a JSON response with the error message
    error_log("Query error: " . $con->error);
    echo json_encode(['error' => 'Query error: ' . $con->error]);
    exit;
}

$orderItems = array();

while ($row = $result->fetch_assoc()) {
    $orderItems[] = $row;
}

// Return the fetched data as JSON
echo json_encode($orderItems);

$con->close();
?>
