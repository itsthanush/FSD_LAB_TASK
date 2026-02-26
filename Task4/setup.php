<?php
include 'db.php';

// Create Customers table
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    email VARCHAR(100),
    city VARCHAR(50)
)");

// Create Products table
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    price DECIMAL(10,2)
)");

// Create Orders table
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    product_id INT,
    quantity INT,
    order_date DATE,
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id),
    FOREIGN KEY (product_id)  REFERENCES Products(product_id)
)");

// Insert sample Customers
mysqli_query($conn, "INSERT INTO Customers (customer_name, email, city) VALUES
    ('Alice',   'alice@mail.com',   'Chennai'),
    ('Bob',     'bob@mail.com',     'Mumbai'),
    ('Charlie', 'charlie@mail.com', 'Delhi')
");

// Insert sample Products
mysqli_query($conn, "INSERT INTO Products (product_name, price) VALUES
    ('Laptop',  55000.00),
    ('Phone',   20000.00),
    ('Tablet',  15000.00)
");

// Insert sample Orders
mysqli_query($conn, "INSERT INTO Orders (customer_id, product_id, quantity, order_date) VALUES
    (1, 1, 1, '2024-01-10'),
    (1, 2, 2, '2024-02-15'),
    (2, 3, 1, '2024-03-05'),
    (3, 1, 2, '2024-03-20'),
    (2, 2, 1, '2024-04-01'),
    (2, 3, 3, '2024-04-10')
");

echo "Tables created and data inserted!";
?>