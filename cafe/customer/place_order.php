<?php
session_start();
include 'C:\xampp\htdocs\cafe\connect.php';

$response = ['status' => 'error', 'message' => 'An error occurred.'];

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

                // Insert the order into the order table
                $insert_query = "INSERT INTO orders (item_name, item_image, quantity) VALUES ('$item_name', '$item_image', '$quantity')";
                mysqli_query($con, $insert_query);
            }
        }

        // Clear the cart after placing the order
        unset($_SESSION['cart']);
        $response['status'] = 'success';
        $response['message'] = 'Order placed successfully.';
    }
}

echo json_encode($response);
?>
