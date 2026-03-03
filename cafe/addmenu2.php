<?php
// Include the database connection file
@include 'connect.php';

// Initialize message array
$message = [];

// Check if user is logged in and is an admin
session_start();
$is_admin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

// Handle Delete Request
if (isset($_POST['delete_product'])) {
    if (!$is_admin) {
        $message[] = 'Cannot delete product: Please login as admin.';
    } else {
        $id = $_POST['delete_id'];
        $delete_query = "DELETE FROM product WHERE id = ?";
        $stmt = $con->prepare($delete_query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $message[] = 'Product deleted successfully';
        } else {
            $message[] = 'Error deleting product: ' . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle Update Request
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'] ?? '';
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

// Fetch Products
$query = "SELECT * FROM product";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/menu.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="css/styleadmin.css">

    <style>
    body {
        background-image: url('img/menub.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        margin: 0;
        font-family: Arial, sans-serif;
        color: #000;
    }

    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #111;
        padding-top: 20px;
        color: #000;
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

    .section {
        margin-left: 250px;
        padding: 20px;
    }

    .container {
        padding: 20px;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        color: #000;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .product-table th,
    .product-table td {
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-align: left;
        color: #000;
    }

    .product-table th {
        background-color: rgba(0, 0, 0, 0.7);
        font-weight: bold;
    }

    .product-table tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .product-table tr:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .btn {
        padding: 5px 10px;
        border: none;
        color: #fff;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-danger {
        background-color: #e74c3c;
    }

    .btn-primary {
        background-color: #3498db;
    }

    .message {
        color: red;
        font-weight: bold;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
   <!-- Sidebar -->
 <div style="height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #343a40; color: #fff; padding-top: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);">
        <a href="staff/adminregister.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Register</a>
        <a href="staff/customerdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">View Customer Details</a>
        <a href="additem2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Add Items</a>
        <a href="addmenu2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">View Menu</a>
        <a href="tabledetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Table Details</a>
        <a href="orders2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Orders</a>
        <a href="bookings.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Reservations</a>
        <a href="customer/signin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Logout</a>
    </div>

    <section class="section menu" aria-label="menu-label" id="menu">
        <div class="container glass-effect">
            <h1 class="headline-1 section-title text-center">Menu</h1>

            <!-- Display messages -->
            <?php if (!empty($message)) : ?>
            <?php foreach ($message as $msg) : ?>
            <div class="message"><?php echo htmlspecialchars($msg); ?></div>
            <?php endforeach; ?>
            <?php endif; ?>

            <!-- Products Table -->
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><img src="uploaded_img/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image"
                                style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                        <td>
                            <form action="updateitem2.php" method="get" style="display:inline;">
                                <input type="hidden" name="product_id"
                                    value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline;">
                                <input type="hidden" name="delete_id"
                                    value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
