<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

// Get user data from session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Please find your registered information as follows:</h2>
    <ul>
        <li><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></li>
        <li><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
