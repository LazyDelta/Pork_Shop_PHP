<?php
// Database connection code
include "./../connect.php"; // Assuming you have a separate file for DB connection

$username = $_POST['username'];
$password = $_POST['password'];

// Check if username and password match
$query = "SELECT userId, permission FROM userdata WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $response = array(
        "status" => "Success",
        "userId" => $row['userId'],
        "permission" => $row['permission']
    );
    echo json_encode($response);
} else {
    $response = array("status" => "Error", "message" => "Incorrect username or password.");
    echo json_encode($response);
}

mysqli_close($con);
?>
