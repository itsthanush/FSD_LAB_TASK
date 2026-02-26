<?php

$name="localhost";
$username="root";
$password="";
$dbname="PaymentDB";


$conn = mysqli_connect("localhost", "root", "", "PaymentDB");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
else{
    echo "Connection Successful";
}
?>