<?php
session_start();
include 'C:\xampp\htdocs\cafe\connect.php';

$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                Gallery Cafe
            </div>
            <ul class="nav-links">
                <li><a href="index2.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservation.php">Reservation</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="team.html">About us</a></li>
                <li><a href="team.html">Contact us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Orders List</h1>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Item Name</th>
                <th>Item Image</th>
                <th>Quantity</th>
                <th>Order Date</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td><img src='../uploaded_img/" . $row['item_image'] . "' alt='" . $row['item_name'] . "' width='50'></td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
</body>

</html>
