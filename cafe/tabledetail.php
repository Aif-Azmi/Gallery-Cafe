<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';

$message = '';

if (isset($_POST['submit'])) {
    $table_number = $_POST['table_number'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO tablecount (table_number, capacity, is_available) VALUES ('$table_number', '$capacity', 1)";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
        exit();
    } else {
        die(mysqli_error($con));
    }
}

if (isset($_POST['toggle'])) {
    $table_id = $_POST['table_id'];
    $currentStatus = mysqli_fetch_assoc(mysqli_query($con, "SELECT is_available FROM tablecount WHERE id='$table_id'"))['is_available'];
    $newStatus = $currentStatus ? 0 : 1;

    $sql = "UPDATE tablecount SET is_available='$newStatus' WHERE id='$table_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        die(mysqli_error($con));
    }
}

if (isset($_POST['delete'])) {
    $table_id = $_POST['table_id'];

    $sql = "DELETE FROM tablecount WHERE id='$table_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        die(mysqli_error($con));
    }
}

if (isset($_GET['success'])) {
    $message = 'Table details inserted successfully';
}

$sql = "SELECT * FROM tablecount";
$result = mysqli_query($con, $sql);
$tables = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleadmin.css">
    <title>Table Registration</title>
    <style>
        .number-pad {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .table-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 150px;
            font-size: 24px;
            font-weight: bold;
            border-radius: 10px;
            border: 2px solid #ccc;
            transition: all 0.3s;
            text-align: center;
            padding: 10px;
        }

        .available {
            background-color: #A3D2CA;
            color: #056676;
        }

        .booked {
            background-color: #E9C46A;
            color: #2A9D8F;
        }

        .table-btn button {
            margin-top: 10px;
            font-size: 14px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            padding: 5px;
        }

        .table-btn .btn-secondary {
            background-color: #056676;
            color: white;
        }

        .table-btn .btn-make-available {
            background-color: #2A9D8F;
            color: white;
        }

        .table-btn .btn-delete {
            background-color: #FF6F61;
            color: white;
        }

        .table-btn:hover {
            transform: scale(1.05);
        }

        .table-btn button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
 <!-- Sidebar -->
 <div class="sidebar" style="height: 100%; width: 250px; position: fixed; top: 0; left: 0; background-color: #333; color: #fff; padding-top: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);">
    <a href="adminpanel.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Dashboard</a>

    <a href="adminregister.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Register</a>
    <a href="staffdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Staff Details</a>
    <a href="customerdetails.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Customer Details</a>
    <a href="additem.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Add Items</a>
    <a href="viewmenu.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">View Menu</a>
    <a href="adminpanel.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Gallery Products</a>
    <a href="tabledetail.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Table Details</a>
    <a href="orders.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Orders</a>
    <a href="bookings.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Reservations</a>
    
    <a href="signin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s, color 0.3s; border-bottom: 1px solid #444;">Logout</a>
</div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Admin Panel</h1>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <div class="container my-5">
            <h1>Register Table</h1>
            <?php if ($message) : ?>
                <div class="alert alert-success"><?= $message ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label>Table Number</label>
                    <input type="text" class="form-control" placeholder="Enter Table Number" name="table_number" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" class="form-control" placeholder="Enter Capacity" name="capacity" autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
        <div class="container my-5">
            <h1>Manage Tables</h1>
            <div class="number-pad">
                <?php foreach ($tables as $table) : ?>
                    <div class="table-btn <?= $table['is_available'] ? 'available' : 'booked' ?>" data-id="<?= $table['id'] ?>" data-status="<?= $table['is_available'] ?>">
                        <?= $table['table_number'] ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="table_id" value="<?= $table['id'] ?>">
                            <button type="submit" name="toggle" class="btn <?= $table['is_available'] ? 'btn-secondary' : 'btn-make-available' ?>">
                                <?= $table['is_available'] ? 'Make Unavailable' : 'Make Available' ?>
                            </button>
                            <button type="submit" name="delete" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
