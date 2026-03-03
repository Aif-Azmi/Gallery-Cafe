<?php
session_start();
include '../connect.php';

if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

$email = $_SESSION['email'];

// Fetch customer details from the database
$sql = "SELECT * FROM login WHERE email='$email'";
$result = mysqli_query($con, $sql);
$customer = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $new_password = $_POST['new_password'];

    // Update customer details in the database
    if (!empty($new_password)) {
        $sql_update = "UPDATE login SET name='$name', address='$address', password='$new_password' WHERE email='$email'";
    } else {
        $sql_update = "UPDATE login SET name='$name', address='$address' WHERE email='$email'";
    }

    if (mysqli_query($con, $sql_update)) {
        echo "Profile updated successfully.";
        $_SESSION['name'] = $name; // Update session name
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            Gallery Cafe
        </div>
        <ul>
            <li><a href="index2.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<div class="container my-5">
    <h1>Edit Profile</h1>
    <form method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $customer['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $customer['address']; ?>" required>
        </div>
        <div class="form-group">
            <label>New Password (leave blank to keep current password)</label>
            <input type="password" class="form-control" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>
</div>
</body>
</html>
