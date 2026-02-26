<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server="localhost";
$usernam="root";
$password="";
$dbname="User_Info";

$conn=mysqli_connect($server,$usernam,$password,$dbname);

if(!$conn){
    die("Not Connected: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        table {
            margin-top: 20px;
        }
        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2442c9;
            color: white;
            border-radius: 5px;
            text-decoration: none;

        }
        .back-btn:hover{
            background-color:#667eea;
            color:white;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn btn-secondary back-btn">Back to Form</a>
        <h2>User Data Table</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                   
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>City</th>
                    <th>Password</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query="SELECT * FROM User_info";
                    $result=mysqli_query($conn,$query);

                    if(!$result){
                        die("Query failed: " . mysqli_error($conn));
                    }

                    if(mysqli_num_rows($result) > 0){
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            
                            
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['phone']."</td>";
                            echo "<td>".$row['city']."</td>";
                            echo "<td>".$row['password']."</td>";
                            echo "<td><a href='update.php?id=".$row['name']."' class='btn btn-success'>Update</a></td>";
                            echo "<td><a href='delete.php?id=".$row['name']."' class='btn btn-danger'>Delete</a></td>";
                            
                        }
                    }
                    else{
                        echo "<tr><td colspan='7' class='text-center'>No data found</td></tr>";
                    }
                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>