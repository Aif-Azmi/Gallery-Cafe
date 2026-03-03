<?php
include 'connect.php';

$message = '';

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
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .table-tile {
            width: 150px;
            height: 150px;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 10px;
            margin: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .table-tile:hover {
            transform: scale(1.05);
        }

        .table-number {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .table-status {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }

        .table-actions {
            position: absolute;
            bottom: 10px;
            width: 100%;
            display: flex;
            justify-content: space-around;
        }

        .btn {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-toggle {
            background-color: #056676;
            color: white;
            border: none;
        }

        .btn-toggle:hover {
            background-color: #045e67;
        }

        .btn-delete {
            background-color: #FF6F61;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background-color: #e85e51;
        }

        .btn-make-available {
            background-color: #2A9D8F;
            color: white;
            border: none;
        }

        .btn-make-available:hover {
            background-color: #247d73;
        }
    </style>
    <title>Manage Tables</title>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Manage Tables</h1>
        <?php if ($message) : ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <div class="table-list">
            <?php foreach ($tables as $table) : ?>
                <div class="table-card">
                    <div class="table-info">
                        <div class="table-number">Table <?php echo $table['table_number']; ?></div>
                        <div class="table-status">
                            Status: <?php echo $table['is_available'] ? '<span class="status-available">Available</span>' : '<span class="status-booked">Booked</span>'; ?>
                        </div>
                    </div>
                    <form method="post">
                        <input type="hidden" name="table_id" value="<?php echo $table['id']; ?>">
                        <button type="submit" name="toggle" class="btn btn-toggle">
                            <?php echo $table['is_available'] ? 'Make Unavailable' : 'Make Available'; ?>
                        </button>
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
