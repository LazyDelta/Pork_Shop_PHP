<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$userId = $_POST['userId'];
$totalPrice = $_POST['totalPrice'];
$orders = json_decode($_POST['orders'], true); // Decode the JSON orders
$status = 'Pending'; // Set initial status to 'Pending'
$dateTime = $_POST['dateTime']; // Get the passed dateTime

// Validate required fields
if (empty($userId) || empty($totalPrice) || empty($orders) || empty($dateTime)) {
    echo json_encode(['error' => 'Missing required fields']);
    exit();
}

// Generate a unique order ID for this order
$orderGroupId = uniqid(); // Unique identifier for this order group

// Insert each product into the orderdetail table
foreach ($orders as $order) {
    $orderId = $order['orderId'];
    $amount = $order['amount'];
    $price = $order['price'];

    $sql = "INSERT INTO orderdetail (order_group_id, total_price, status, orderId, userId, order_date) 
            VALUES ('".$orderGroupId."', '".$totalPrice."', '".$status."', '".$orderId."', '".$userId."', '".$dateTime."')";

    if ($con->query($sql) === TRUE) {
        // Success message here
    } else {
        echo json_encode(['error' => 'Error inserting order detail: ' . $con->error]);
        exit();
    }
}

echo json_encode(['success' => 'Order confirmed successfully']);
$con->close();
?>
