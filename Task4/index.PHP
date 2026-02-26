<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <style>
        body        { font-family: Arial; margin: 30px; background: #f4f4f4; }
        h2          { color: #333; border-bottom: 2px solid #4CAF50; padding-bottom: 5px; }
        .container  { max-width: 900px; margin: auto; }
        .card       { background: white; padding: 20px; margin-bottom: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table       { width: 100%; border-collapse: collapse; }
        th          { background: #4CAF50; color: white; padding: 10px; text-align: left; }
        td          { padding: 10px; border-bottom: 1px solid #ddd; }
        tr:hover td { background: #f1f1f1; }
        .highlight  { background: #fff8e1; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">


<!-- ===================== -->
<!-- 1. CUSTOMER ORDER HISTORY (JOIN) -->
<!-- ===================== -->
<div class="card">
    <h2>Customer Order History</h2>
    <?php
    // JOIN: Customers + Orders + Products
    $sql = "SELECT 
                c.customer_name,
                c.city,
                p.product_name,
                p.price,
                o.quantity,
                (p.price * o.quantity) AS total_value,
                o.order_date
            FROM Orders o
            JOIN Customers c ON o.customer_id = c.customer_id
            JOIN Products  p ON o.product_id  = p.product_id
            ORDER BY o.order_date DESC";

    $result = mysqli_query($conn, $sql);
    ?>
    <table>
        <tr>
            <th>Customer</th>
            <th>City</th>
            <th>Product</th>
            <th>Price (₹)</th>
            <th>Qty</th>
            <th>Total (₹)</th>
            <th>Order Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['city'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= number_format($row['price'], 2) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= number_format($row['total_value'], 2) ?></td>
            <td><?= $row['order_date'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>


<!-- ===================== -->
<!-- 2. HIGHEST VALUE ORDER (SUBQUERY) -->
<!-- ===================== -->
<div class="card">
    <h2>Highest Value Order</h2>
    <?php
    // Subquery: find the order where (price * quantity) is the highest
    $sql = "SELECT 
                c.customer_name,
                p.product_name,
                o.quantity,
                (p.price * o.quantity) AS total_value,
                o.order_date
            FROM Orders o
            JOIN Customers c ON o.customer_id = c.customer_id
            JOIN Products  p ON o.product_id  = p.product_id
            WHERE (p.price * o.quantity) = (
                SELECT MAX(p2.price * o2.quantity)
                FROM Orders o2
                JOIN Products p2 ON o2.product_id = p2.product_id
            )";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Total Value (₹)</th>
            <th>Order Date</th>
        </tr>
        <tr class="highlight">
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= number_format($row['total_value'], 2) ?></td>
            <td><?= $row['order_date'] ?></td>
        </tr>
    </table>
</div>


<!-- ===================== -->
<!-- 3. MOST ACTIVE CUSTOMER (SUBQUERY) -->
<!-- ===================== -->
<div class="card">
    <h2>Most Active Customer</h2>
    <?php
    // Subquery: customer who placed the most number of orders
    $sql = "SELECT 
                c.customer_name,
                c.email,
                c.city,
                COUNT(o.order_id) AS total_orders
            FROM Customers c
            JOIN Orders o ON c.customer_id = o.customer_id
            GROUP BY c.customer_id
            HAVING COUNT(o.order_id) = (
                SELECT MAX(order_count)
                FROM (
                    SELECT COUNT(order_id) AS order_count
                    FROM Orders
                    GROUP BY customer_id
                ) AS counts
            )";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <table>
        <tr>
            <th>Customer</th>
            <th>Email</th>
            <th>City</th>
            <th>Total Orders</th>
        </tr>
        <tr class="highlight">
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['city'] ?></td>
            <td><?= $row['total_orders'] ?></td>
        </tr>
    </table>
</div>


</div>
</body>
</html>
```

---

## How the Queries Work

**Order History JOIN:**
```
Orders  →  JOIN Customers  (match customer_id)
        →  JOIN Products   (match product_id)
```
This pulls data from all 3 tables in one query.

**Highest Value Order Subquery:**
```
WHERE total = (SELECT MAX(total) FROM ...)
```
The inner query finds the max value first, then the outer query fetches that row.

**Most Active Customer Subquery:**
```
HAVING count = (SELECT MAX(count) FROM (...) )