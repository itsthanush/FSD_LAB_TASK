<?php
include 'dp.php';

$user_id     = (int) $_POST['user_id'];
$merchant_id = (int) $_POST['merchant_id'];
$amount      = (float) $_POST['amount'];

// Check balance
$result = mysqli_query($conn, "SELECT balance FROM Users WHERE user_id = $user_id");
$user   = mysqli_fetch_assoc($result);

// fetch merchant name to display
$mresult  = mysqli_query($conn, "SELECT name FROM Merchants WHERE merchant_id = $merchant_id");
$merchant = mysqli_fetch_assoc($mresult);

$message = "";
$type    = "";
$new_balance = 0;

if ($user['balance'] < $amount) {
    $message = "Insufficient Balance! You only have ₹" . $user['balance'];
    $type    = "failed";

} else {

    mysqli_begin_transaction($conn);

    try {
        $q1 = mysqli_query($conn, "UPDATE Users SET balance = balance - $amount WHERE user_id = $user_id");
        if (!$q1) throw new Exception(mysqli_error($conn));

        $q2 = mysqli_query($conn, "UPDATE Merchants SET balance = balance + $amount WHERE merchant_id = $merchant_id");
        if (!$q2) throw new Exception(mysqli_error($conn));

        mysqli_query($conn, "INSERT INTO Transactions (user_id, merchant_id, amount, status)
                              VALUES ($user_id, $merchant_id, $amount, 'Success')");

        mysqli_commit($conn);

        // Fetch the updated balance from the database
        $res_updated = mysqli_query($conn, "SELECT balance FROM Users WHERE user_id = $user_id");
        $user_updated = mysqli_fetch_assoc($res_updated);
        $new_balance = $user_updated['balance'];

        $message = "₹" . $amount . " successfully sent to " . $merchant['name'];
        $type    = "success";

    } catch (Exception $e) {
        mysqli_rollback($conn);

        mysqli_query($conn, "INSERT INTO Transactions (user_id, merchant_id, amount, status)
                              VALUES ($user_id, $merchant_id, $amount, 'Failed')");

        $message = "Payment Failed! " . $e->getMessage();
        $type    = "failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Result</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 400px;
        }

        .icon { font-size: 60px; margin-bottom: 15px; }

        .message {
            font-size: 16px;
            margin-bottom: 25px;
            color: #555;
        }

        /* Green card for success */
        .success .icon-box { color: #27ae60; }
        .success h2        { color: #27ae60; margin-bottom: 10px; }
        .success .top-bar  { height: 6px; background: #27ae60; border-radius: 10px 10px 0 0; margin: -40px -40px 30px -40px; }

        /* Red card for failed */
        .failed .icon-box { color: #e74c3c; }
        .failed h2        { color: #e74c3c; margin-bottom: 10px; }
        .failed .top-bar  { height: 6px; background: #e74c3c; border-radius: 10px 10px 0 0; margin: -40px -40px 30px -40px; }

        .amount {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            margin: 5px;
        }

        .btn-green  { background: #27ae60; color: white; }
        .btn-outline{ border: 2px solid #2c3e50; color: #2c3e50; }
        .btn:hover  { opacity: 0.85; }
    </style>
</head>
<body>

<div class="card <?= $type ?>">

    <!-- colored top bar -->
    <div class="top-bar"></div>

    <?php if ($type === 'success'): ?>

        <div class="icon-box">✅</div>
        <h2>Payment Successful!</h2>
        <div class="amount">₹<?= number_format($amount, 2) ?></div>
        <p style="font-weight: bold; color: #27ae60; margin-bottom: 10px;">New Balance: ₹<?= number_format($new_balance, 2) ?></p>
        <p class="message"><?= $message ?></p>
        <a href="payment.php"  class="btn btn-green">Make Another Payment</a>
        <a href="history.php"  class="btn btn-outline">View History</a>

    <?php else: ?>

        <div class="icon-box">❌</div>
        <h2>Payment Failed!</h2>
        <div class="amount">₹<?= number_format($amount, 2) ?></div>
        <p class="message"><?= $message ?></p>
        <a href="payment.php"  class="btn btn-green">Try Again</a>
        <a href="history.php"  class="btn btn-outline">View History</a>

    <?php endif; ?>

</div>

</body>
</html>