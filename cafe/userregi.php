<?php
include 'connect.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // insert query
    $sql = "INSERT INTO login (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
    $result = mysqli_query($con, $sql);
    if($result){
        //echo "Data inserted Successfully";
        header('location:display.php');
    } else {
        die(mysqli_error($con));
    }
}
?>








<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login</title>
</head>

<body>
     <!-- Sidebar -->
     <div class="sidebar" style="height: 100%; width: 250px; position: fixed; top: 0; left: 0; background-color: #111; padding-top: 20px;">
        <a href="adminpanel.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">Dashboard</a>
        <a href="adminregister.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">Register</a>
        <a href="display.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">View Staff Details</a>
        <a href="display.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">View Customer Details</a>
        <a href="additem.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">Add Items</a>
        <a href="additem.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">View Menu</a>
        <a href="tabledetails.php" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">Table Details</a>
        <a href="#" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">Reservations</a>
        <a href="#" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block; transition: 0.3s;">Customer Reviews</a>
    </div>

    <div class="container my-5">
        <h1>Registration</h1>
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
                <label>Mobile Number</label>
                <input type="text" class="form-control" placeholder="Enter Your Mobile Number" name="mobile" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter Your Password" name="password" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>