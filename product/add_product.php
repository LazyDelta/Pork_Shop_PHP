<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// $productId = $_POST['productId'];
$productType = $_POST['productType'];
$productName = $_POST['productName'];
$price = $_POST['price'];

// Handle file upload
if (isset($_FILES['image']['name'])) {
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $uploadPath = './../uploads/' . basename($imageName);

    // Move uploaded file to the server
    if (move_uploaded_file($imageTmpName, $uploadPath)) {
        $imageURL = $uploadPath;
    } else {
        $imageURL = './../uploads/'; // Handle error or set a default image path
    }
} else {
    $imageURL = './../uploads/'; // Handle case where no image is uploaded
}

$sql = "INSERT INTO product (productType, productName, price, image)
        -- INSERT INTO product (productId, productType, productName, price, image)
        VALUES ('".$productType."', '".$productName."', '".$price."', '".$imageURL."')";
        // VALUES ('".$productId."', '".$productType."', '".$productName."', '".$price."', '".$imageURL."')";

if ($con->query($sql) === TRUE) {
    echo json_encode("Succeed");
} else {
    echo json_encode("Error: " . $sql . "<br>" . $con->error);
}

$con->close();
?>
