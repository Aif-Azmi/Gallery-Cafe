<?php
session_start();

if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];

    // Check if the cart session variable exists
    if (isset($_SESSION['cart'])) {
        // Find and remove the item from the cart
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                // Reindex array to prevent gaps
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }

    // Redirect back to the cart page
    header('Location: cart.php');
    exit();
}
?>
