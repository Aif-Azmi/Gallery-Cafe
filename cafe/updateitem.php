<?php
// Include the database connection file
@include 'connect.php';

// Initialize message array
$message = [];

// Check if a product ID is provided
if (isset($_POST['product_id']) || isset($_GET['product_id'])) {
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : $_GET['product_id'];

    // Fetch product data
    $query = "SELECT * FROM product WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        $message[] = 'Product not found';
    }

    // Check if the form is submitted to update the product
    if (isset($_POST['update_product'])) {
        $product_name = $_POST['product_name'] ?? '';
        $product_description = $_POST['product_description'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $product_category = $_POST['product_category'] ?? '';
        $product_quantity = $_POST['product_quantity'] ?? '';
        $product_type = $_POST['product_type'] ?? ''; // New field
        $product_image = $_FILES['product_image']['name'] ?? '';
        $product_image_tmp_name = $_FILES['product_image']['tmp_name'] ?? '';
        $product_image_folder = 'uploaded_img/' . $product_image;

        if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_category) || empty($product_quantity) || empty($product_type)) {
            $message[] = 'Please fill out all fields';
        } else {
            if (!empty($product_image)) {
                move_uploaded_file($product_image_tmp_name, $product_image_folder);
                $update_query = "UPDATE product SET name=?, description=?, price=?, category=?, quantity=?, type=?, image=? WHERE id=?";
                $stmt = $con->prepare($update_query);
                $stmt->bind_param('ssdsissi', $product_name, $product_description, $product_price, $product_category, $product_quantity, $product_type, $product_image, $product_id);
            } else {
                $update_query = "UPDATE product SET name=?, description=?, price=?, category=?, quantity=?, type=? WHERE id=?";
                $stmt = $con->prepare($update_query);
                $stmt->bind_param('ssdsiss', $product_name, $product_description, $product_price, $product_category, $product_quantity, $product_type, $product_id);
            }
            if ($stmt->execute()) {
                $message[] = 'Product updated successfully';
            } else {
                $message[] = 'Error updating product: ' . $stmt->error;
            }
            $stmt->close();
        }
    }
} else {
    $message[] = 'Product ID not provided';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/additem.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img/item.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .admin-product-form-container {
            background-color: rgba(255, 255, 255, 0.6); /* Semi-transparent background for form */
            backdrop-filter: blur(10px); /* Glass effect for form */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px; /* Maximum width of the form */
        }

        h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        .box {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .message {
            display: block;
            text-align: center;
            color: red;
            margin-bottom: 20px;
        }

        .back-btn {
            margin-top: 20px;
            background-color: #6c757d;
        }

        .back-btn:hover {
            background-color: #5a6268;
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
<div class="container">
    <div class="admin-product-form-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?product_id=' . htmlspecialchars($product_id); ?>" method="post" enctype="multipart/form-data">
            <h3>Update Product</h3>
            <?php if (!empty($message)) : ?>
                <?php foreach ($message as $msg) : ?>
                    <div class="message"><?php echo htmlspecialchars($msg); ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($product)) : ?>
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <input type="text" placeholder="Enter product name" name="product_name" class="box" value="<?php echo htmlspecialchars($product['name']); ?>">
                <textarea placeholder="Enter product description" name="product_description" class="box"><?php echo htmlspecialchars($product['description']); ?></textarea>
                <input type="number" placeholder="Enter product price" name="product_price" class="box" value="<?php echo htmlspecialchars($product['price']); ?>">
                <select name="product_category" class="box">
                    <option value="">Select Category</option>
                    <option value="Sri Lankan" <?php echo $product['category'] == 'Sri Lankan' ? 'selected' : ''; ?>>Sri Lankan</option>
                    <option value="Indian" <?php echo $product['category'] == 'Indian' ? 'selected' : ''; ?>>Indian</option>
                    <option value="European" <?php echo $product['category'] == 'European' ? 'selected' : ''; ?>>European</option>
                    <option value="Japanese" <?php echo $product['category'] == 'Japanese' ? 'selected' : ''; ?>>Japanese</option>
                </select>
                <select name="product_type" class="box">
                    <option value="">Select Type</option>
                    <option value="Food" <?php echo $product['type'] == 'Food' ? 'selected' : ''; ?>>Food</option>
                    <option value="Drink" <?php echo $product['type'] == 'Drink' ? 'selected' : ''; ?>>Drink</option>
                    <option value="Coffee" <?php echo $product['type'] == 'Coffee' ? 'selected' : ''; ?>>Coffee</option>
                </select>
                <input type="number" placeholder="Enter product quantity" name="product_quantity" class="box" min="0" value="<?php echo htmlspecialchars($product['quantity']); ?>">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
                <input type="submit" class="btn" name="update_product" value="Update Product">
                <a href="addmenu.php" class="btn back-btn">Back to Menu</a>
            <?php else: ?>
                <div class="message">No product data available to update</div>
                <a href="addmenu.php" class="btn back-btn">Back to Menu</a>
            <?php endif; ?>
        </form>
    </div>
</div>
</body>
</html>
