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

$sql= "SELECT * FROM User_info ORDER BY name ASC";
$result=mysqli_query($conn,$sql);

if(!$result){
    die("Query failed: " . mysqli_error($conn));
}
while($row = $result->fetch_assoc()){
    echo $row['name'] . "<br>";
}
mysqli_close($conn);
?>



