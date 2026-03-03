<?php
@include 'connect.php';

if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']); // Ensure $id is an integer
    $select = mysqli_query($con, "SELECT * FROM product WHERE id = $id");

    if (!$select) {
        // SQL error
        echo "<script>alert('Error executing query');</script>";
        echo "<script>window.location.href='displayitems.php';</script>";
        exit();
    }

    $row = mysqli_fetch_assoc($select);

    if (!$row) {
        // No product found with this ID
        echo "<script>alert('Product not found');</script>";
        echo "<script>window.location.href='displayitems.php';</script>";
        exit();
    }
} else {
    // 'edit' parameter not set
    echo "<script>alert('Invalid request');</script>";
    echo "<script>window.location.href='displayitems.php';</script>";
    exit();
}

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    
    // Handle image upload if necessary
    if (!empty($_FILES['product_image']['name'])) {
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
        $product_image_folder = 'uploaded_img/' . $product_image;
        move_uploaded_file($product_image_tmp_name, $product_image_folder);

        // Update query to include image
        $update = mysqli_query($con, "UPDATE product SET name='$name', description='$description', price='$price', category='$category', image='$product_image' WHERE id=$id");
    } else {
        // Update query without image
        $update = mysqli_query($con, "UPDATE product SET name='$name', description='$description', price='$price', category='$category' WHERE id=$id");
    }

    if ($update) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.location.href='displayitems.php';</script>";
    } else {
        echo "<script>alert('Could not update the product');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    < <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/stylem.css">
</head>
<body>

<div class="container">
    <div class="product-form">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            <textarea name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
            <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
            <input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required>
            <input type="file" name="product_image" class="box">
            <button type="submit" name="update">Update Product</button>
        </form>
    </div>
</div>

</body>
</html>
