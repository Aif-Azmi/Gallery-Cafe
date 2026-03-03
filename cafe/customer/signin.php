<?php
session_start(); // Start session to persist login state

include '../connect.php'; // Include your database connection script

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch user details based on email and password from login table
    $sql_user = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $result_user = mysqli_query($con, $sql_user);

    // Query to fetch user details based on email and password from admin_details table
    $sql_admin = "SELECT * FROM admin_details WHERE email='$email' AND password='$password'";
    $result_admin = mysqli_query($con, $sql_admin);

    // Query to fetch user details based on email and password from staflogin table
    $sql_staff = "SELECT * FROM staflogin WHERE email='$email' AND password='$password'";
    $result_staff = mysqli_query($con, $sql_staff);

    if (mysqli_num_rows($result_user) == 1) {
        $user = mysqli_fetch_assoc($result_user);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $user['name'];
        header('Location: index2.php');
        exit(); // Ensure no further code runs after redirection
    } elseif (mysqli_num_rows($result_admin) == 1) {
        $admin = mysqli_fetch_assoc($result_admin);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $admin['name'];
        header('Location: ../adminpanel.php');
        exit();
    } elseif (mysqli_num_rows($result_staff) == 1) {
        $staff = mysqli_fetch_assoc($result_staff);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $staff['name'];
        header('Location: ../staff/staffregister.php');
        exit();
    } else {
        echo "Invalid email or password. Please try again.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Assuming you have a custom CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: url('../img/item.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff; /* Ensure text is readable on the background */
        }
        .container {
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent background for the form */
            border-radius: 15px; /* Rounded corners */
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            backdrop-filter: blur(10px); /* Glass effect */
            -webkit-backdrop-filter: blur(10px); /* Safari */
            max-width: 400px;
            margin: 100px auto; /* Center the form vertically and horizontally */
            color: #343a40; /* Text color inside the form */
        }
        .form-control {
            background: rgba(255, 255, 255, 0.8); /* Slightly transparent background for inputs */
            border: 1px solid #ddd;
            border-radius: 25px; /* Rounded corners */
            padding: 10px;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff; /* Modern blue color */
            border: none;
            border-radius: 25px; /* Rounded button */
            padding: 10px 20px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        nav {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: white; /* Set the background color of the navigation bar to white */
            color: #343a40; /* Set text color to match the rest of the site */
        }
        nav .logo {
            font-size: 24px;
            font-weight: bold;
        }
        nav ul {
            display: flex;
            list-style: none;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #343a40; /* Set link color to match the text color */
            font-weight: bold;
        }
        nav ul li a:hover {
            color: #007bff; /* Change link color on hover */
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            Gallery Cafe
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="menubelo.php">Menu</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="about.php">aboutus</a></li>
        </ul>
    </nav>
</header>
<div class="container my-5">
    <h1>Login</h1>
    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Enter Your email" name="email" autocomplete="off" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Enter Your Password" name="password" autocomplete="off" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Sign In</button>
    </form>
    <p class="mt-3">
        Don't have an account? <a href="userregistration.php">Register</a>
    </p>
</div>
</body>
</html>
