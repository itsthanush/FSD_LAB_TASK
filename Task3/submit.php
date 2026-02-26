<?php

$server="localhost";
$usernam="root";
$password="";
$dbname="User_Info";

$conn=mysqli_connect($server,$usernam,$password,$dbname);

if(!$conn){
    echo "Not Connected";
}
else{
    echo "Connected";
}

$name = $_POST['name'];
$email = $_POST['email'];
$phoneno = $_POST['phoneno'];
$city = $_POST['city'];
$password = $_POST['password'];

$sql = "INSERT INTO User_info(`name`, `email`, `phone`, `city`, `password`) VALUES ('$name', '$email', '$phoneno', '$city', '$password')";

$result = mysqli_query($conn, $sql);

if($result){
    echo "Data Inserted";
}
else{
    echo "Data Not Inserted";
    echo mysqli_error($conn);

}


mysqli_close($conn);


?>
