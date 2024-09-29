<?php
include './../connect.php';
if (!$con) {
    echo "connection error";
}

$queryResult = $con->query("SELECT * FROM product");
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[] = $fetchData;
}

echo json_encode($result);

?>
