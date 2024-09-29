<?php
include './../connect.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$userId = isset($_POST['userId']) ? $_POST['userId'] : null;

if ($userId) {
    // Fetch only orders for this specific userId
    $query = "
      SELECT order_group_id, Orders.orderId, orderdetail.total_price, orderdetail.order_date, orderdetail.status, userdata.username
      FROM orderdetail
      JOIN Orders ON orderdetail.orderId = Orders.orderId
      JOIN userdata ON Orders.userId = userdata.userId
      WHERE orderdetail.userId = '".$userId."'
      GROUP BY order_group_id ORDER BY order_group_id DESC
    ";
} else {
    // Fetch all orders
    $query = "
      SELECT order_group_id, Orders.orderId, orderdetail.total_price, orderdetail.order_date, orderdetail.status, userdata.username
      FROM orderdetail
      JOIN Orders ON orderdetail.orderId = Orders.orderId
      JOIN userdata ON Orders.userId = userdata.userId
      GROUP BY order_group_id ORDER BY order_group_id DESC
    ";
}

$result = $con->query($query);
$orderDetails = array();

while ($row = $result->fetch_assoc()) {
    $orderDetails[] = $row;
}

echo json_encode($orderDetails);

$con->close();
?>
