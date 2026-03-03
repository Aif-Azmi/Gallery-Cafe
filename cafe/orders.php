<?php
session_start();

// Include the database connection file
include 'C:\xampp\htdocs\cafe\connect.php';

// Handle order deletion if an ID is posted
if (isset($_POST['id'])) {
    // Get the order ID from the POST request
    $orderId = intval($_POST['id']);

    // Prepare the SQL statement to delete the order
    $query = "DELETE FROM orders WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, 'i', $orderId);
        
        // Execute the statement
        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            // Redirect back to the orders page with a success message
            header("Location: orders.php?status=success");
            exit();
        } else {
            // If an error occurs, return an error message
            echo "Error: " . mysqli_error($con);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If statement preparation fails, return an error message
        echo "Error preparing statement: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}

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
        
        .btn-done {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-done:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" style="height: 100%; width: 250px; position: fixed; top: 0; left: 0; background-color: #333; color: #fff; padding-top: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);">
        <a href="adminpanel.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Dashboard</a>
        <a href="adminpanel.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Make Admin</a>
        <a href="adminregister.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Register</a>
        <a href="staffdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Staff Details</a>
        <a href="customerdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Customer Details</a>
        <a href="additem.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Add Items</a>
        <a href="addmenu.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Menu</a>
        <a href="adminpanel.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Gallery Products</a>
        <a href="tabledetail.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Table Details</a>
        <a href="bookings.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Reservations</a>
        <a href="orders.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Pending Orders</a>
        <a href="customer/signin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Logout</a>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($order = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$order['id']}</td>";
                    echo "<td>{$order['item_name']}</td>";
                    echo "<td><img src='uploaded_img/{$order['item_image']}' alt='{$order['item_name']}' style='width: 100px; height: 100px; object-fit: cover;'></td>";
                    echo "<td>{$order['quantity']}</td>";
                    echo "<td>{$order['order_date']}</td>";
                    echo "<td><button class='btn-done' onclick='markOrderDone({$order['id']})'>Done</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function markOrderDone(orderId) {
            if (confirm('Are you sure you want to mark this order as done?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'orders.php';
                
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = orderId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
