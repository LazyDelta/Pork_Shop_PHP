<?php
include './../connect.php';

if (!$con) {
    echo "connection error";
}

$username = $_POST['username'];

$queryResult = $con->query("SELECT username, tel_number ,image FROM userdata WHERE username = '".$username."'");
$result = array();

while ($fetchData = $queryResult->fetch_assoc()) {
    $result[] = $fetchData;
}

echo json_encode($result);
?>
