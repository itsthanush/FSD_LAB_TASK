<?php
include 'db.php';

// Users table (people who send money)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Users (
    user_id  INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(100),
    email    VARCHAR(100),
    balance  DECIMAL(10,2)
)");

// Merchants table (people who receive money)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Merchants (
    merchant_id  INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100),
    balance      DECIMAL(10,2)
)");

// Transactions table (payment history/log)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT,
    merchant_id    INT,
    amount         DECIMAL(10,2),
    status         VARCHAR(20),    -- 'Success' or 'Failed'
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Sample Users
mysqli_query($conn, "INSERT INTO Users (name, email, balance) VALUES
    ('Alice', 'alice@mail.com', 5000.00),
    ('Bob',   'bob@mail.com',   1000.00)
");

// Sample Merchants
mysqli_query($conn, "INSERT INTO Merchants (name, balance) VALUES
    ('Amazon Store', 2000.00),
    ('Flipkart',     3000.00)
");

echo "Setup Done!";
?>