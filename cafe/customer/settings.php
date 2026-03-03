<?php
session_start();
// Ensure the user is logged in
if (!isset($_SESSION['name'])) {
    header('Location: signin.php');
    exit;
}

// Fetch user details from the database
// Assuming you have a function getUserDetails($userId)
$userDetails = getUserDetails($_SESSION['userId']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Settings</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Manage Your Settings</h1>
    </header>

    <main>
        <form action="update_profile.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $userDetails['email']; ?>" required>

            <!-- Add more fields as necessary -->

            <button type="submit">Update Profile</button>
        </form>
    </main>
</body>
</html>

<?php
function getUserDetails($userId) {
    // Mock function to simulate fetching user details from the database
    // Replace with your actual database query
    return [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com'
    ];
}
?>
