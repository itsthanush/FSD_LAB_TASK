<?php
include 'dp.php';
$users = mysqli_query($conn, "SELECT * FROM Users");
$merchants = mysqli_query($conn, "SELECT * FROM Merchants");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body       { font-family: Segoe UI; background: #f0f2f5; display: flex; justify-content: center; margin-top: 60px; }
        .card      { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 400px; }
        h2         { color: #2c3e50; margin-bottom: 20px; border-left: 4px solid #27ae60; padding-left: 10px; }
        label      { display: block; margin-bottom: 5px; font-size: 14px; color: #555; }
        select, input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        button     { width: 100%; padding: 12px; background: #27ae60; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #1e8449; }
    </style>
</head>

<body>
    <div class="container">
        <h2>Make a payment</h2>
       <form method="POST" action="process.php">
            <label>Select User (Sender)</label>
            <select name="user_id">
            <?php while($user = mysqli_fetch_assoc($users)): ?>
                <option value="<?= $user['user_id'] ?>"><?= $user['name'] ?> - ₹<?= number_format($user['balance'], 2) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Select Marchant (Receiver)</label>
        <select name="merchant_id">
            <?php while($merchant = mysqli_fetch_assoc($merchants)): ?>
                <option value="<?= $merchant['merchant_id'] ?>"><?= $merchant['name'] ?></option>
            <?php endwhile; ?>
        </select>

        
        <label>Amount (₹)</label>
        <input type="number" name="amount" placeholder="Enter amount" min="1" required>

        <button type="submit">Pay Now</button>
        </form>
</body>
</html>