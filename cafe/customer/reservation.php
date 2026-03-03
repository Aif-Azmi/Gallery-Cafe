<?php
include 'C:\xampp\htdocs\cafe\connect.php';

$message = '';

if (isset($_POST['submit'])) {
    $customer_name = $_POST['customer_name'];
    $table_number = $_POST['table_number'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $notes = $_POST['notes'];

    // Check if the table is available
    $tableCheckSql = "SELECT is_available FROM tablecount WHERE table_number='$table_number'";
    $tableCheckResult = mysqli_query($con, $tableCheckSql);
    if ($tableCheckResult) {
        $tableCheckRow = mysqli_fetch_assoc($tableCheckResult);
        if ($tableCheckRow['is_available']) {
            // Table is available, insert reservation
            $reservationSql = "INSERT INTO reservation (customer_name, table_id, reservation_date, reservation_time, notes) 
                               VALUES ('$customer_name', '$table_number', '$reservation_date', '$reservation_time', '$notes')";
            $reservationResult = mysqli_query($con, $reservationSql);
            if ($reservationResult) {
                // Optionally update the table status to unavailable
                $updateTableSql = "UPDATE tablecount SET is_available=0 WHERE table_number='$table_number'";
                mysqli_query($con, $updateTableSql);

                $message = 'Table reserved successfully';
            } else {
                die(mysqli_error($con));
            }
        } else {
            $message = 'Table is not available';
        }
    } else {
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('../img/table.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .login-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .cart-icon {
            position: absolute;
            left: -25px; /* Adjust to position behind user icon */
            width: 24px; /* Adjust size as needed */
            height: 24px; /* Adjust size as needed */
        }

        .login-icon a {
            display: flex;
            align-items: center;
        }

        .login-icon a img {
            width: 20px; /* Adjust size as needed */
            height: 20px; /* Adjust size as needed */
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .image-section {
            flex: 1;
            padding: 20px;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .content-section {
            flex: 2;
            padding: 20px;
        }

        .content-section h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .content-section p {
            line-height: 1.6;
            margin-bottom: 20px;
            color: #555;
        }

        .reservation-form {
            padding: 20px;
            max-width: 600px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .reservation-form h1 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
        }

        .reservation-form input, .reservation-form textarea, .reservation-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .reservation-form input:focus, .reservation-form textarea:focus, .reservation-form button:focus {
            border-color: #555;
            outline: none;
        }

        .reservation-form textarea {
            resize: vertical;
            height: 100px;
        }

        .reservation-form button {
            background-color: #333;
            color: #fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .reservation-form button:hover {
            background-color: #555;
        }

        .alert {
            background-color: #f44336;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-section, .content-section {
                flex: 1 1 100%;
            }
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
                <li><a href="index2.php" target="_self">Home</a></li>
                <li><a href="menu.php" target="_self">Menu</a></li>
                <li><a href="reservation.php" target="_self">Reservation</a></li>
                <li><a href="gallery.php" target="_self">Gallery</a></li>
                <li><a href="about2.php" target="_self">About Us</a></li>
                <li><a href="contact.php" target="_self">Contact Us</a></li>
            </ul>
            <div class="login-icon">
                <img src="../img/cart.png" alt="Cart Icon" class="cart-icon">
                <a href="signin.php" target="_self">
                    <img src="../img/user.png" alt="User Icon">
                </a>
            </div>
        </nav>
    </header>
    
    <div class="reservation-form">
        <h1>Reserve a Table</h1>
        <?php if (!empty($message)) : ?>
            <div class="alert"><?= $message ?></div>
        <?php endif; ?>
        <form id="reservationForm" method="POST" action="reservation.php">
            <input type="text" id="customerName" name="customer_name" placeholder="Customer Name" required>
            <input type="text" id="tableNumber" name="table_number" placeholder="Table Number" required>
            <input type="date" id="reservationDate" name="reservation_date" required>
            <input type="time" id="reservationTime" name="reservation_time" required>
            <textarea id="notes" name="notes" placeholder="Notes"></textarea>
            <button type="submit" name="submit">Reserve</button>
        </form>
    </div>

    <script src="js/reservation_script.js"></script>

    <script>
        function toggleUserPanel() {
            var userPanel = document.getElementById('user-panel');
            userPanel.style.display = userPanel.style.display === 'none' || userPanel.style.display === '' ? 'block' : 'none';
        }

        function toggleCartPanel() {
            var cartPanel = document.getElementById('cart-panel');
            cartPanel.style.display = cartPanel.style.display === 'none'
            || cartPanel.style.display === '' ? 'block' : 'none';
        }

        // Close panels when clicking outside
        document.addEventListener('click', function(event) {
           
            var userPanel = document.getElementById('user-panel');
            var cartPanel = document.getElementById('cart-panel');
            if (!event.target.closest('.login-icon')) {
                userPanel.style.display = 'none';
            }
            if (!event.target.closest('.cart-icon')) {
                cartPanel.style.display = 'none';
            }
        });
    </script>
    
    <footer>
        <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
    </footer>
</body>
</html>