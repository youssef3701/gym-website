<?php
session_start();
require 'db_connection.php';  // Include your database connection

// Check if the admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS -->
    <style>
        /* Admin Dashboard Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .admin-header {
            background-color: #333;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            margin: 0;
        }

        .admin-header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .admin-header nav ul li {
            margin: 0 15px;
        }

        .admin-header nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .admin-header nav ul li a:hover {
            text-decoration: underline;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .actions {
            display: flex;
            justify-content: space-around;
            margin-top: 2rem;
        }

        .actions a {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .actions a:hover {
            background-color: #0056b3;
        }

        footer {
            margin-top: 2rem;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="add_user.php">Add User</a></li>
                <li><a href="view_users.php">View Users</a></li>
                <li><a href="logout.php">Logout</a></li>
                <a href="delete_user.php" class="btn">Delete User</a>
            </ul>
        </nav>
    </header>

    <main class="dashboard-container">
        <h2 class="dashboard-title">Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>

        <p>This is your admin panel. Use the actions below to manage users and the system.</p>

        <div class="actions">
            <a href="add_user.php">Add New User</a>
            <a href="view_users.php">View All Users</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gym Management System. All rights reserved.</p>
    </footer>
</body>
</html>