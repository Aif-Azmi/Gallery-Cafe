<?php
include 'connect.php'; // Assuming connect.php includes your database connection

if (isset($_GET['deleteid']) && isset($_GET['table'])) {
    $id = mysqli_real_escape_string($con, $_GET['deleteid']);
    $table = mysqli_real_escape_string($con, $_GET['table']);

    // Assuming `id` is the primary key column name in your table
    $sql = "DELETE FROM `$table` WHERE `id` = '$id'";
    
    if (mysqli_query($con, $sql)) {
        header('Location: customerdetails.php'); // Redirect to the customer details page after deletion
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
