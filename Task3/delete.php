<?php
$server="localhost";
$usernam="root";
$password="";
$dbname="User_Info";

$conn=mysqli_connect($server,$usernam,$password,$dbname);

if(!$conn){
    die("Not Connected: " . mysqli_connect_error());
}

if(isset($_GET['name'])){
    $name = $_GET['name'];
    $sql = "DELETE FROM User_info WHERE name = '$name'";

    if(mysqli_query($conn, $sql)){
        header("Location: Table.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>