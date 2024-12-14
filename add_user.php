<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not an admin, redirect to the login page or access denied page
    header("Location: login.php");
    exit;
}

require 'db_connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name']; // Match the form's name attribute
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password']; // Get the confirm password
    $role = $_POST['role']; // Capture role from the form (typically will be 'coach')

    // Check for empty fields
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
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

    // Prepare the SQL statement to insert the user along with their role
    $stmt = $conn->prepare("INSERT INTO signup (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    // Execute the query
    if ($stmt->execute()) {
        echo "New member registered successfully!";
        header("Location: view_users.php"); // Redirect to view_users page after successful registration
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<!-- HTML Form for Adding a User -->
<h2>Add a New User</h2>
<form action="add_user.php" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" required>

    <label for="confirm-password">Confirm Password</label>
    <input type="password" name="confirm-password" required>

    <label for="role">Role</label>
    <select name="role" required>
        <option value="coach">Coach</option>
        <option value="user">User</option>
    </select>
    <button type="submit">Add User</button>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</form>
