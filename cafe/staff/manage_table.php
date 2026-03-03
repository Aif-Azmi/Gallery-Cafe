<?php
include 'C:\xampp\htdocs\cafe\connect.php';

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
    <title>Manage Tables</title>
    <style>
        body {
            background-image: url('../img/cartb.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

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
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .available {
            background-color: rgba(163, 210, 202, 0.5);
            color: #056676;
        }

        .booked {
            background-color: rgba(233, 196, 106, 0.5);
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

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }
    </style>
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
        <a href="../customer/signin.php" style="display: block; padding: 15px 20px; text-decoration: none; font-size: 18px; color: #fff; transition: background-color 0.3s;">Logout</a>
    </div>
    <div class="container my-5">
        
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
