<?php
session_start();
include 'C:\xampp\htdocs\cafe\connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['product_id'];
            $query = "SELECT * FROM product WHERE id = '$product_id'";
            $result = mysqli_query($con, $query);
            $product = mysqli_fetch_assoc($result);

            if ($product) {
                $item_name = $product['name'];
                $item_image = $product['image'];
                $quantity = $item['quantity'];
                $order_date = date('Y-m-d H:i:s'); // Get the current date and time

                // Insert the order into the order table with the current date and time
                $insert_query = "INSERT INTO orders (item_name, item_image, quantity, order_date) 
                                 VALUES ('$item_name', '$item_image', '$quantity', '$order_date')";
                mysqli_query($con, $insert_query);
            }
        }

        // Clear the cart after placing the order
        unset($_SESSION['cart']);
    }
}
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
    .cart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 auto;
        max-width: 1200px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        width: 100%;
        max-width: 800px;
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
        width: 100%;
        max-width: 800px;
    }

    .pay-now-button {
        display: block;
        width: 200px;
        padding: 10px;
        margin: 20px auto;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1.2em;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        /* Remove underline */
        transition: background-color 0.3s ease;
    }

    .pay-now-button:hover {
        background-color: #0056b3;
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
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="about2.php">About us</a></li>
            <li><a href="contact.php">Contact us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Your Cart</h1>
        <div class="cart-container">
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
                echo "<button class='pay-now-button' onclick='handlePayNow()'>Place Order</button>";
            } else {
                echo "<p>No items in cart</p>";
            }
            ?>
        </div>
    </main>
    <script>
    function handlePayNow() {
        // Send an AJAX request to place the order
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'place_order.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                const response = JSON.parse(xhr.responseText);
                if (xhr.status === 200 && response.status === 'success') {
                    // Create a hidden link element to download the receipt
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
                } else {
                    // Handle errors (display error message)
                    alert('Error: ' + response.message);
                }
            }
        };
        xhr.send();
    }
    </script>


    </script>
</body>

</html>