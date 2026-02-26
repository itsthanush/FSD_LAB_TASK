<?php

$name="localhost";
$username="root";
$password="";
$dbname="OrderManagement";


$conn = mysqli_connect("localhost", "root", "", "OrderManagement");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
else{
    echo "Connection Successful";
}
?>