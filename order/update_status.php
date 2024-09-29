<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to update the status of all "Pending" orders to "Complete"
$sql = "UPDATE orderdetail SET status = 'Complete' WHERE status = 'Pending'";

if ($con->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Statuses updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update statuses']);
}

$con->close();
?>
