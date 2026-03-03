<?php
session_start();

// Include the database connection file
@include 'C:\xampp\htdocs\cafe\connect.php';

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total_price = 0; // Initialize total cart price
    $receipt_content = "Receipt\n\n";

    foreach ($_SESSION['cart'] as $item) {
        // Retrieve product details
        $product_id = $item['product_id'];
        $query = "SELECT * FROM product WHERE id = '$product_id'";
        $result = mysqli_query($con, $query);
        $product = mysqli_fetch_assoc($result);

        if ($product) {
            $item_total = $product['price'] * $item['quantity'];
            $total_price += $item_total;

            $receipt_content .= "Product: {$product['name']}\n";
            $receipt_content .= "Price: LKR {$product['price']}\n";
            $receipt_content .= "Quantity: {$item['quantity']}\n";
            $receipt_content .= "Total: LKR {$item_total}\n\n";
        }
    }

    $receipt_content .= "Grand Total: LKR {$total_price}\n";

    // Set headers for file download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="receipt.txt"');
    echo $receipt_content;
    exit;
} else {
    echo "No items in cart";
}
?>
