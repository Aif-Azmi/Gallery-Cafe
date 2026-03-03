<?php
include 'connect.php';

$message = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $position = $_POST['position'];
    $password = $_POST['password'];

    // Generate a short unique ID
    $unique_id = '';

    if ($position == 'customer') {
        $unique_id = 'CUST' . rand(1000, 9999); // Example: CUST1234
        $table = 'login';
        $id_column = 'Customer_id';
    } elseif ($position == 'staff') {
        $unique_id = 'STAFF' . rand(1000, 9999); // Example: STAFF1234
        $table = 'staflogin';
        $id_column = 'Staff_id';
    } else {
        die("Invalid position selected.");
    }

    // Insert query
    $sql = "INSERT INTO $table (name, email, address, mobile, password, $id_column) VALUES ('$name', '$email', '$address', '$mobile', '$password', '$unique_id')";
    if (mysqli_query($con, $sql)) {
        $message = 'Data inserted successfully';
        // Redirect to avoid form resubmission
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
        exit();
    } else {
        // Capture detailed error message
        $message = 'Error: ' . mysqli_error($con);
    }
}

// Check for success message
if (isset($_GET['success'])) {
    $message = 'Data inserted successfully';
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styleadmin.css">

    <title>Admin Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/customers.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        
        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-container h1 {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert-success {
            margin-top: 20px;
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
    <!-- Content -->
    <div class="content">
        <div class="container my-5">
            <div class="form-container">
                <h1>Registration</h1>
                <?php
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Your name" name="name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter Your email" name="email" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Enter Your Address" name="address" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" placeholder="Enter Your Mobile Number" name="mobile" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <select class="form-control" name="position">
                            <option value="customer">Customer</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter Your Password" name="password" autocomplete="off">
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
