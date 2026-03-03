<?php
// Start the session
session_start();

// Include the database connection file
@include 'C:\xampp\htdocs\cafe\connect.php';

// Initialize message array
$message = [];

// Check if the user is logged in as admin
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Fetch product details for the given product_id
$product_id = $_POST['product_id'] ?? '';

if ($product_id) {
    $query = "SELECT * FROM product WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

// Handle Update Request
if (isset($_POST['update_product'])) {
    if (isAdmin()) {
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
    } else {
        $message[] = 'Cannot update item. Login as admin.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Update Menu Item</h1>

    <!-- Display messages -->
    <?php if (!empty($message)) : ?>
        <?php foreach ($message as $msg) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Update Form -->
    <?php if ($product) : ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

        <div class="form-group">
            <label for="product_name">Name</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            <div class="invalid-feedback">Please enter a product name.</div>
        </div>

        <div class="form-group">
            <label for="product_description">Description</label>
            <textarea class="form-control" name="product_description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <div class="invalid-feedback">Please enter a product description.</div>
        </div>

        <div class="form-group">
            <label for="product_price">Price</label>
            <input type="number" class="form-control" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
            <div class="invalid-feedback">Please enter a product price.</div>
        </div>

        <div class="form-group">
            <label for="product_category">Category</label>
            <select class="form-control" name="product_category" required>
                <option value="">Select Category</option>
                <option value="Sri Lankan" <?php echo $product['category'] == 'Sri Lankan' ? 'selected' : ''; ?>>Sri Lankan</option>
                <option value="Indian" <?php echo $product['category'] == 'Indian' ? 'selected' : ''; ?>>Indian</option>
                <option value="European" <?php echo $product['category'] == 'European' ? 'selected' : ''; ?>>European</option>
                <option value="Japanese" <?php echo $product['category'] == 'Japanese' ? 'selected' : ''; ?>>Japanese</option>
            </select>
            <div class="invalid-feedback">Please select a product category.</div>
        </div>

        <div class="form-group">
            <label for="product_quantity">Quantity</label>
            <input type="number" class="form-control" name="product_quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" min="0" required>
            <div class="invalid-feedback">Please enter a product quantity.</div>
        </div>

        <div class="form-group">
            <label for="product_type">Type</label>
            <select class="form-control" name="product_type" required>
                <option value="">Select Type</option>
                <option value="Food" <?php echo $product['type'] == 'Food' ? 'selected' : ''; ?>>Food</option>
                <option value="Drink" <?php echo $product['type'] == 'Drink' ? 'selected' : ''; ?>>Drink</option>
                <option value="Coffee" <?php echo $product['type'] == 'Coffee' ? 'selected' : ''; ?>>Coffee</option>
            </select>
            <div class="invalid-feedback">Please select a product type.</div>
        </div>

        <div class="form-group">
            <label for="product_image">Image</label>
            <input type="file" class="form-control-file" name="product_image">
        </div>

        <button type="submit" name="update_product" class="btn btn-primary btn-block">Update Product</button>
    </form>
    <?php else : ?>
    <div class="alert alert-danger" role="alert">Product not found.</div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Bootstrap validation
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>