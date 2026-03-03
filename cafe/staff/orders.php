<?php
session_start();

// Include the database connection file
include 'C:\xampp\htdocs\cafe\connect.php';

// Fetch orders from the database
$query = "SELECT * FROM orders";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Error: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            margin: 20px auto;
        }
    </style>
</head>
<body>
   <!-- Sidebar -->
   <div style="height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #343a40; color: #fff; padding-top: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);">
        <a href="adminregister.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Register</a>
        <a href="customerdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">View Customer Details</a>
        <a href="../additem2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Add Items</a>
        <a href="../addmenu2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">View Menu</a>
        <a href="tabledetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Table Details</a>
        <a href="../orders2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Orders</a>
        <a href="bookings.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Reservations</a>
        <a href="../customer/signin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Logout</a>
    </div>
    <header>
        <h1>Orders List</h1>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Item Image</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($order = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$order['id']}</td>";
                    echo "<td>{$order['item_name']}</td>";
                    echo "<td><img src='../uploaded_img/{$order['item_image']}' alt='{$order['item_name']}' style='width: 100px; height: 100px; object-fit: cover;'></td>";
                    echo "<td>{$order['quantity']}</td>";
                    echo "<td>{$order['order_date']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
