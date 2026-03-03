<?php
session_start();

// Include the database connection file
@include 'C:\xampp\htdocs\cafe\connect.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details to check stock availability and get the price
    $query = "SELECT * FROM product WHERE id = '$product_id'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        $available_quantity = $product['quantity']; // Available stock
        $price = $product['price']; // Product price

        if ($quantity > $available_quantity) {
            // If requested quantity exceeds available stock, set to maximum available quantity
            $quantity = $available_quantity;
        }

        // Check if the cart session variable exists, if not, create it
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        $product_found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item_quantity = $item['quantity'] + $quantity;

                // Ensure the total quantity does not exceed available stock
                if ($item_quantity > $available_quantity) {
                    $item['quantity'] = $available_quantity;
                } else {
                    $item['quantity'] = $item_quantity;
                }

                // Update the total price for the item
                $item['total_price'] = $item['quantity'] * $price;

                $product_found = true;
                break;
            }
        }

        // If product not found in the cart, add it
        if (!$product_found) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $quantity * $price
            ];
        }
    }

    // Calculate the total price for all items in the cart
    $cart_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cart_total += $item['total_price'];
    }

    // Store the total price in the session
    $_SESSION['cart_total'] = $cart_total;

    // Redirect back to the menu page or a success page
    header('Location: menu.php');
    exit();
}
?>
