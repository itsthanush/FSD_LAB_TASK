<?php
$server="localhost";
$usernam="root";
$password="";
$dbname="User_Info";

$conn=mysqli_connect($server,$usernam,$password,$dbname);

if(!$conn){
    die("Not Connected: " . mysqli_connect_error());
}

if(isset($_POST['name'])){
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phoneno'];
    $city = $_POST['city'];
    $password = $_POST['password'];

    $sql = "UPDATE User_info SET name='$name', email='$email', phone='$phone', city='$city', password='$password' WHERE name='$name'";

    if(mysqli_query($conn, $sql)){
        header("Location: Table.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>