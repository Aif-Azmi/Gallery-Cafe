<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/additem.css">
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

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            color: #fff;
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

        .container {
            margin-left: 250px; /* Adjust based on sidebar width */
            padding: 20px;
            position: relative;
            height: calc(100vh - 20px); /* Adjust based on sidebar height */
            display: flex;
            align-items: center;
            justify-content: center;
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

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .container {
                margin-left: 0;
            }
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
<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<span class="message">' . htmlspecialchars($msg) . '</span>';
    }
}
?>
<div class="container">
    <div class="admin-product-form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <h3>Add New Product</h3>
            <input type="text" placeholder="Enter product name" name="product_name" class="box">
            <textarea placeholder="Enter product description" name="product_description" class="box"></textarea>
            <input type="number" placeholder="Enter product price" name="product_price" class="box">
            <select name="product_category" class="box">
                <option value="">Select Category</option>
                <option value="Sri Lankan">Sri Lankan</option>
                <option value="Indian">Indian</option>
                <option value="European">European</option>
                <option value="Japanese">Japanese</option>
            </select>
            <select name="product_type" class="box">
                <option value="">Select Type</option>
                <option value="Food">Food</option>
                <option value="Drink">Drink</option>
                <option value="Coffee">Coffee</option>
            </select>
            <input type="number" placeholder="Enter product quantity" name="product_quantity" class="box" min="0">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="submit" class="btn" name="add_product" value="Add Product">
        </form>
    </div>
</div>
<script>
    document.querySelector('.dropbtn').addEventListener('click', function() {
        var dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
</script>
</body>
</html>
