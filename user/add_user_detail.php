<?php
include './../connect.php';

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$tel_number = $_POST['tel_number'];
$image_path = null;

// Check if an image is uploaded
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "./../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_path = $target_file;
}

// Check if the user already exists
$query = "SELECT * FROM userdata WHERE username = '".$username."'";
$result = $con->query($query);

if ($result->num_rows > 0) {
    // User exists, perform UPDATE
    if($image_path !== null) {
        // Update with image
        $update_query = "UPDATE userdata SET tel_number = '".$tel_number."', image = '".$image_path."' WHERE username = '".$username."'";
    } else {
        // Update without image
        $update_query = "UPDATE userdata SET tel_number = '".$tel_number."' WHERE username = '".$username."'";
    }
    $con->query($update_query);
} else {
    // User doesn't exist, perform INSERT
    if($image_path !== null) {
        // Insert with image
        $insert_query = "INSERT INTO userdata (username, tel_number, image) VALUES ('".$username."', '".$tel_number."', '".$image_path."')";
    } else {
        // Insert without image
        $insert_query = "INSERT INTO userdata (username, tel_number) VALUES ('".$username."', '".$tel_number."')";
    }
    $con->query($insert_query);
}

$con->close();
echo json_encode("Succeed");
?>
