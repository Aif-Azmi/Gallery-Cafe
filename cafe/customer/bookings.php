<?php
include 'C:\xampp\htdocs\cafe\connect.php';

// Handle deletion if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservation_id'])) {
    $reservationId = $_POST['reservation_id'];

    // Delete the reservation from the database
    $deleteSql = "DELETE FROM reservation WHERE id = ?";
    $stmt = mysqli_prepare($con, $deleteSql);
    mysqli_stmt_bind_param($stmt, 'i', $reservationId);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Reservation marked as available.');</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

// Fetch all bookings from the database
$bookingSql = "SELECT * FROM reservation";
$bookingResult = mysqli_query($con, $bookingSql);

if (!$bookingResult) {
    die('Query failed: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styleandmin.css">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('../img/table.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .container {
            margin-left: 250px; /* Adjust based on sidebar width */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2); /* Semi-transparent background */
            backdrop-filter: blur(10px); /* Glass effect */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }

        h1 {
    font-size: 32px; /* Increased font size */
    margin-bottom: 20px;
    color: #fff; /* Changed color to white */
    text-align: center;
}

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 0.6); /* Semi-transparent background for table */
            backdrop-filter: blur(10px); /* Glass effect for table */
            border-radius: 5px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: rgba(255, 255, 255, 0.4); /* Semi-transparent background for table header */
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent background for even rows */
        }

        /* Center the table using Bootstrap's grid system */
        .table-wrapper {
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .container {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="adminpanel.php">Dashboard</a>
        <a href="adminpanel.php">Make Admin</a>
        <a href="adminregister.php">Register</a>
        <a href="display.php">View Staff Details</a>
        <a href="display.php">View Customer Details</a>
        <a href="additem.php">Add Items</a>
        <a href="additem.php">View Menu</a>
        <a href="adminpanel.php">Gallery Products</a>
        <a href="tabledetails.php">Table Details</a>
        <a href="#" style="background-color: #575757;">Reservations</a>
        <a href="#">Customer Reviews</a>
    </div>

    <div class="container">
        <h1>Table Bookings</h1>
        <div class="table-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Table Number</th>
                        <th>Reservation Date</th>
                        <th>Reservation Time</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($bookingResult)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['customer_name']) ?></td>
                            <td><?= htmlspecialchars($row['table_id']) ?></td>
                            <td><?= htmlspecialchars($row['reservation_date']) ?></td>
                            <td><?= htmlspecialchars($row['reservation_time']) ?></td>
                            <td><?= htmlspecialchars($row['notes']) ?></td>
                            <td>
                                <form action="" method="post" onsubmit="return confirm('Are you sure you want to mark this table as available?');">
                                    <input type="hidden" name="reservation_id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Available</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
