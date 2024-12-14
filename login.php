<?php
session_start();
require 'db_connection.php'; // Include your database connection

$error = ""; // To store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (empty($email) || empty($password)) {
        $error = "Both fields are required.";
    } else {
        // Query the database to check if the user exists
        $stmt = $conn->prepare("SELECT id, name, password, role FROM signup WHERE email = ?");
        $stmt->bind_param("s", $email); // Bind the email parameter
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with the provided email exists
        if ($result->num_rows > 0) {
            // Fetch user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role']; // Add role to the session

                // Regenerate session ID
                session_regenerate_id();

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: admin_dashboard.php");
                }elseif($user['role']=== 'coach'){
                    header("Location: coach_dashboard.php");
                    
                } elseif ($user['role'] === 'user'){
                    header("Location: user_dashboard.php"); // Regular user dashboard
                }
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }

        // Close the statement
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles2.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="form-container">
        <h1>Login</h1>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
