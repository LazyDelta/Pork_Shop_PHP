<?php
include "./../connect.php";

if (!$con) {
    echo json_encode("Error: Connection error");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Check if the username already exists
$checkUserQuery = "SELECT * FROM userdata WHERE username = '$username'";
$userResult = mysqli_query($con, $checkUserQuery);

if (mysqli_num_rows($userResult) > 0) {
    echo json_encode("Error: Username already exists");
    exit();
}

// Insert the new user into the database
$sql = "INSERT INTO userdata (username, password, confirmPassword) VALUES ('".$username."', '".$password."', '".$confirmPassword."')";

if (mysqli_query($con, $sql)) {
    echo json_encode("Success");
} else {
    echo json_encode("Error: Could not register user");
}

mysqli_close($con);
?>
