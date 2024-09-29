<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$productId = $_POST['productId'];
$productType = $_POST['productType'];
$productName = $_POST['productName'];
$price = $_POST['price'];

// Handle image upload
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "./../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Update query with image
    $con->query("UPDATE product SET productType = '".$productType."', productName = '".$productName."', price = '".$price."', image = '".$target_file."' WHERE productId = '".$productId."'");
} else {
    // Update query without image
    $con->query("UPDATE product SET productType = '".$productType."', productName = '".$productName."', price = '".$price."' WHERE productId = '".$productId."'");
}

$con->close();
echo json_encode("Succeed");
?>
