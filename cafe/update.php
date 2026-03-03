<?php
include 'connect.php'; // Assuming connect.php includes your database connection

$name = $email = $address = $mobile = ''; // Initialize variables

if (isset($_GET['updateid']) && isset($_GET['table'])) {
    $id = mysqli_real_escape_string($con, $_GET['updateid']);
    $table = mysqli_real_escape_string($con, $_GET['table']);

    // Validate the table name to prevent SQL injection
    if ($table !== 'login' && $table !== 'staflogin') {
        die("Invalid table name: " . htmlspecialchars($table));
    }

    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

        $sql = "UPDATE `$table` SET `name` = '$name', `email` = '$email', `address` = '$address', `mobile` = '$mobile' WHERE `id` = '$id'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // Redirect to customerdetails.php if the table is 'login'
            $redirect_url = ($table === 'login') ? 'customerdetails.php' : htmlspecialchars($table) . "details.php";
            header("Location: " . $redirect_url);
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        $sql = "SELECT * FROM `$table` WHERE `id` = '$id' LIMIT 1";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $address = $row['address'];
            $mobile = $row['mobile'];
        } else {
            echo "No record found.";
        }
    }
} else {
    echo "Invalid request.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('img/customers.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #343a40; /* Dark grey text color */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 15px; /* Rounded corners */
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            backdrop-filter: blur(10px); /* Glass effect */
        }


        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .btn-primary {
            background-color: #007bff; /* Modern blue color */
            border: none;
            border-radius: 25px; /* Rounded button */
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Slightly darker shadow on hover */
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 3px rgba(38, 143, 255, 0.5); /* Custom focus ring */
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            border-color: #007bff; /* Border color on focus */
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25); /* Focus shadow */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">Update Record</h1>
            <form method="POST" class="d-flex flex-column">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</body>

</html>