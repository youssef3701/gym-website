<?php
session_start();
include('db_connection.php');  // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {  // Use 'user_id' session variable
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Get the user ID from session

// Retrieve user data from the database
$sql = "SELECT * FROM signup WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id); // Bind user ID to prevent SQL injection
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User data not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user_dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome to Your Dashboard, <?php echo htmlspecialchars($user['name']); ?></h2>

        <!-- Membership Information -->
        <div class="membership-info">
            <h3>Your Membership Details</h3>
            <p><strong>Membership Status:</strong> <?php echo $user['membership']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        </div>

        <!-- Additional Information -->
        <div class="additional-info">
            <h3>Additional Information</h3>
            <p><strong>Join Date:</strong> <?php echo isset($user['join_date']) ? $user['join_date'] : 'N/A'; ?></p>
            <p><strong>Last Login:</strong> <?php echo isset($user['last_login']) ? $user['last_login'] : 'N/A'; ?></p>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
