<?php
include 'C:\xampp\htdocs\cafe\connect.php';

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
    <link rel="stylesheet" href="../css/styleadmin.css">

    <title>Staff Menu</title>
</head>

<body>
     <!-- Sidebar -->
     <div style="height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #343a40; color: #fff; padding-top: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);">
        <a href="adminregister.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Register</a>
        <a href="customerdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">View Customer Details</a>
        <a href="../additem2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Add Items</a>
        <a href="../addmenu2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">View Menu</a>
        <a href="tabledetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Table Details</a>
        <a href="../orders2.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Orders</a>
        <a href="bookings.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Reservations</a>
        <a href="customers/sighnin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Register</h1>
            <a href="customer/signin.php" class="btn btn-danger">Logout</a>
        </div>
        <div class="container my-5">
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
