<?php
// Include the database connection file
@include 'connect.php';

// Initialize message array
$message = [];

// Check if a product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product data from the database
    $query = "SELECT * FROM product WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        $message[] = "Product not found.";
    }
} else {
    $message[] = "No product ID provided.";
}

// Handle form submission for updating the product
if (isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'] ?? '';
    $product_description = $_POST['product_description'] ?? '';
    $product_price = $_POST['product_price'] ?? '';
    $product_category = $_POST['product_category'] ?? '';
    $product_image = $_FILES['product_image']['name'] ?? '';
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'] ?? '';
    $product_image_folder = 'uploaded_img/' . $product_image;
    $image_width = 300; // Set the desired width
    $image_height = 300; // Set the desired height

    if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_category)) {
        $message[] = 'Please fill out all fields';
    } else {
        if (!empty($product_image)) {
            if (resizeImage($product_image_tmp_name, $product_image_folder, $image_width, $image_height)) {
                $update_query = "UPDATE product SET name=?, description=?, price=?, category=?, image=? WHERE id=?";
                $stmt = $con->prepare($update_query);
                $stmt->bind_param('ssdssi', $product_name, $product_description, $product_price, $product_category, $product_image, $product_id);
            } else {
                $message[] = 'Error resizing image';
            }
        } else {
            $update_query = "UPDATE product SET name=?, description=?, price=?, category=? WHERE id=?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param('ssdsi', $product_name, $product_description, $product_price, $product_category, $product_id);
        }
        if ($stmt->execute()) {
            $message[] = 'Product updated successfully';
        } else {
            $message[] = 'Error updating product: ' . $stmt->error;
        }
        $stmt->close();
    }
}

// Function to resize the image
function resizeImage($source, $destination, $width, $height) {
    list($src_width, $src_height, $src_type) = getimagesize($source);
    $src_aspect = $src_width / $src_height;
    $dst_aspect = $width / $height;

    if ($src_aspect > $dst_aspect) {
        // Source image is wider than destination aspect ratio
        $new_height = $height;
        $new_width = $width * ($src_width / $src_height);
    } else {
        // Source image is taller than destination aspect ratio
        $new_width = $width;
        $new_height = $height * ($src_height / $src_width);
    }

    $dst_image = imagecreatetruecolor($width, $height);

    switch ($src_type) {
        case IMAGETYPE_GIF:
            $src_image = imagecreatefromgif($source);
            break;
        case IMAGETYPE_JPEG:
            $src_image = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $src_image = imagecreatefrompng($source);
            break;
        default:
            return false;
    }

    // Copy and resize the image
    imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $width, $height, $src_width, $src_height);

    switch ($src_type) {
        case IMAGETYPE_GIF:
            imagegif($dst_image, $destination);
            break;
        case IMAGETYPE_JPEG:
            imagejpeg($dst_image, $destination);
            break;
        case IMAGETYPE_PNG:
            imagepng($dst_image, $destination);
            break;
        default:
            return false;
    }

    imagedestroy($src_image);
    imagedestroy($dst_image);

    return true;
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
</head>
<body>

<div class="container">
    <div class="admin-product-form-container">
        <?php
        // Display messages if any
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<span class="message">' . $msg . '</span>';
            }
        }
        ?>

        <?php if (isset($row)): ?>
        <form action="updatemenu.php?id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
            <h3>Update Product</h3>
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <input type="text" placeholder="Enter product name" name="product_name" class="box" value="<?php echo $row['name']; ?>">
            <textarea placeholder="Enter product description" name="product_description" class="box"><?php echo $row['description']; ?></textarea>
            <input type="number" placeholder="Enter product price" name="product_price" class="box" value="<?php echo $row['price']; ?>">
            <select name="product_category" class="box">
                <option value="">Select Category</option>
                <option value="Sri Lankan" <?php if ($row['category'] == 'Sri Lankan') echo 'selected'; ?>>Sri Lankan</option>
                <option value="Indian" <?php if ($row['category'] == 'Indian') echo 'selected'; ?>>Indian</option>
                <option value="European" <?php if ($row['category'] == 'European') echo 'selected'; ?>>European</option>
                <option value="Japanese" <?php if ($row['category'] == 'Japanese') echo 'selected'; ?>>Japanese</option>
            </select>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="submit" class="btn" name="update_product" value="Update Product">
            <input type="submit" class="btn" name="delete_product" value="Delete Product" onclick="return confirm('Are you sure you want to delete this product?');">
        </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
