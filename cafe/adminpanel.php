<?php
include 'connect.php';

$message = '';

// Handle form submission for adding an admin
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Insert query
    $sql = "INSERT INTO admin_details (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
    if (mysqli_query($con, $sql)) {
        $message = 'Admin account created successfully';
        // Redirect to avoid form resubmission
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
        exit();
    } else {
        // Capture detailed error message
        $message = 'Error: ' . mysqli_error($con);
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM admin_details WHERE id = $id";
    if (mysqli_query($con, $delete_query)) {
        $message = 'Admin account deleted successfully';
        // Redirect to avoid re-executing the delete query
        header('Location: ' . $_SERVER['PHP_SELF'] . '?deleted=true');
        exit();
    } else {
        $message = 'Error deleting record: ' . mysqli_error($con);
    }
}

// Check for success or delete message
if (isset($_GET['success'])) {
    $message = 'Admin account created successfully';
} elseif (isset($_GET['deleted'])) {
    $message = 'Admin account deleted successfully';
}

// Fetch admin details
$admin_query = "SELECT id, name, email, mobile FROM admin_details";
$admin_result = mysqli_query($con, $admin_query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleadmin.css">
    <title>Create Admin Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/ab6.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

       
        .content {
            margin-left: 250px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        h1, h2 {
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

        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert-success {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
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

    <div class="content">
        <div class="form-container">
            <h1>Create Admin Account</h1>
            <?php
            if ($message) {
                echo '<div class="alert alert-success">' . $message . '</div>';
            }
            ?>
            <form method="post">
                <input type="text" class="box" placeholder="Enter Admin Name" name="name" autocomplete="off" required>
                <input type="email" class="box" placeholder="Enter Admin Email" name="email" autocomplete="off" required>
                <input type="text" class="box" placeholder="Enter Admin Mobile" name="mobile" autocomplete="off" required>
                <input type="password" class="box" placeholder="Enter Admin Password" name="password" autocomplete="off" required>
                <button type="submit" class="btn-primary" name="submit">Create Account</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Admin Details</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($admin_result) > 0) {
                        while ($row = mysqli_fetch_assoc($admin_result)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['mobile']) . "</td>
                                    <td><a href='" . $_SERVER['PHP_SELF'] . "?delete=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align: center;'>No admin details found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
