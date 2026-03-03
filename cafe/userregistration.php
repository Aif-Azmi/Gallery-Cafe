<?php
include 'connect.php';

$message = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Insert query
    $sql = "INSERT INTO login (name, email, address, mobile, password) VALUES ('$name', '$email', '$address', '$mobile', '$password')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $message = 'Data inserted successfully';
        // Redirect to avoid form resubmission
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
        exit();
    } else {
        die(mysqli_error($con));
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
</head>

<body>
   

    <!-- Content -->
    <div class="content">

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
