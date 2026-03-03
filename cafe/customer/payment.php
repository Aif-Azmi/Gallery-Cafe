<?php
session_start(); // Start session to persist login state

// Include the database connection file
@include 'C:\xampp\htdocs\cafe\connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
    <style>
        /* Modern styling for cart items */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #333;
            padding: 10px 0;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .logo {
            color: #fff;
            font-size: 1.5em;
            font-weight: bold;
        }
        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        .nav-links li {
            margin-left: 20px;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
        }
        main {
            flex: 1;
            width: 100%;
            max-width: 800px;
            padding: 20px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }
        .cart-item-details {
            flex: 1;
            text-align: left;
        }
        .cart-item-details h2 {
            margin: 0;
            font-size: 1.2em;
        }
        .cart-item-details p {
            margin: 5px 0;
        }
        .cart-item button {
            background-color: #dc3545;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .cart-item button:hover {
            background-color: #c82333;
        }
        .cart-total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .pay-now {
            display: block;
            width: 200px;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .pay-now:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function handlePayNow() {
            // Create a hidden link element
            const link = document.createElement('a');
            link.href = 'download_receipt.php';
            link.download = 'receipt.txt';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Navigate to payment.php after downloading receipt
            setTimeout(() => {
                window.location.href = 'payment.php';
            }, 1000); // Delay to ensure download starts
        }
    </script>
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
        <h1>Your Cart</h1>
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total_price = 0; // Initialize total cart price

            foreach ($_SESSION['cart'] as $item) {
                // Retrieve product details
                $product_id = $item['product_id'];
                $query = "SELECT * FROM product WHERE id = '$product_id'";
                $result = mysqli_query($con, $query);
                $product = mysqli_fetch_assoc($result);

                if ($product) {
                    $item_total = $product['price'] * $item['quantity'];
                    $total_price += $item_total;

                    echo "<div class='cart-item'>";
                    echo "<img src='../uploaded_img/{$product['image']}' alt='{$product['name']}'>";
                    echo "<div class='cart-item-details'>";
                    echo "<h2>{$product['name']}</h2>";
                    echo "<p>Price: LKR {$product['price']}</p>";
                    echo "<p>Quantity: {$item['quantity']}</p>";
                    echo "<p>Total: LKR {$item_total}</p>";
                    echo "<form action='remove_from_cart.php' method='post'>";
                    echo "<input type='hidden' name='product_id' value='{$product['id']}'>";
                    echo "<button type='submit' name='remove_from_cart'>Remove</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            }

            echo "<div class='cart-total'>Grand Total: LKR {$total_price}</div>";
            echo "<button class='pay-now' onclick='handlePayNow()'>Pay Now</button>";
        } else {
            echo "<p>No items in cart</p>";
        }
        ?>
    </main>
</body>
</html>
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