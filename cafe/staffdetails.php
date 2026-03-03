<?php
include 'connect.php'; // Assuming connect.php includes your database connection

$search = '';
$table = 'staflogin'; // Default to staff table
$headers = ['S.No', 'ID', 'Name', 'Email', 'Address', 'Mobile', 'Operation']; // Updated headers

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($con, $_POST['search']);
}

$sql = "SELECT * FROM `$table`";
if (!empty($search)) {
    $sql .= " WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%' OR `address` LIKE '%$search%' OR `mobile` LIKE '%$search%'";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styleadmin.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: url('img/staffdetails.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .table-container table {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .logout-button {
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
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
    <a href="viewmenu.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Menu</a>
    <a href="adminpanel.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Gallery Products</a>
    <a href="tabledetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Table Details</a>
    <a href="bookings.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Reservations</a>
    <a href="#" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Customer Reviews</a>
    <a href="signin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Logout</a>
</div>

    <!-- Logout Button -->
    <div class="logout-button">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container my-5">
            <h1 class="text-center">SEARCH</h1>
            <form method="POST" class="d-flex mb-4 justify-content-center">
                <input class="form-control me-2" type="search" placeholder="Search" name="search" value="<?php echo htmlspecialchars($search); ?>" style="width: 300px;">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <?php
                            foreach ($headers as $header) {
                                echo "<th scope='col'>{$header}</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            $sno = 1; // Initialize a counter variable
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['Staff_id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $address = $row['address'];
                                $mobile = $row['mobile'];
                                echo "<tr>
                                        <td>{$sno}</td>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$email}</td>
                                        <td>{$address}</td>
                                        <td>{$mobile}</td>
                                        <td>
                                           <a href='update.php?updateid={$id}&table={$table}' class='btn btn-primary text-light'>Update</a>
                                           <a href='delete.php?deleteid={$id}&table={$table}' class='btn btn-danger text-light'>Delete</a>
                                        </td>
                                    </tr>";
                                $sno++;
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='7'>No records found</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
