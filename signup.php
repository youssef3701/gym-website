<?php
require 'db_connection.php'; // Include database connection

session_start();

// Generate and store the CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));  // Generates a random token
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name']; // Match the form's name attribute
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password']; // Get the confirm password
    $DateofBirth = $_POST['DateofBirth'];

    // Check for empty fields
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($DateofBirth)) {
        echo "All fields are required.";
        exit;
    }

    // Validate passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email exists (to prevent duplicate emails)
    $stmt = $conn->prepare("SELECT id FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email already exists.";
        exit;
    }

    // Assign roles automatically
    // Admin account
    if ($email == 'admin@example.com') {
        $role = 'admin';
    }
    // Coach account
    elseif ($email == 'youssef@example.com' || $email == 'mike@example.com' || $email == 'lily@gmail.com') {
        $role = 'coach';
    }
    // Default role for other users (optional, e.g., 'user')
    else {
        $role = 'user';
    }

    // Prepare the SQL statement to insert the user along with their role
    $stmt = $conn->prepare("INSERT INTO signup (name, email, password, DateofBirth, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $hashed_password, $DateofBirth, $role);

    // Execute the query
    if ($stmt->execute()) {
        echo "New member registered successfully!";
        header("Location: login.html"); // Redirect to login page
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self';">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles2.css"> <!-- Link to your CSS file --> 
    <script src="script.js"> </script>
</head>
<body>
    <div class="form-container">
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST" onsubmit="return validateEmail() && validatePasswords()">
            <label for="fullname">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <label for="DateofBirth">Date of Birth</label>
            <input type="date" id="dob" name="DateofBirth" placeholder="Enter your Date of Birth" required>
            <button type="submit">Sign Up</button>
        </form>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="your_generated_token_here">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
