<?php
session_start();

// Ensure the user is logged in and is a coach
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'coach') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .nav {
            display: flex;
            justify-content: space-around;
            margin-bottom: 2rem;
        }

        .nav a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav a:hover {
            background-color: #0056b3;
        }

        .section {
            margin-bottom: 2rem;
        }

        .section h3 {
            margin-bottom: 1rem;
            color: #555;
        }

        .section p {
            line-height: 1.6;
        }

        .logout {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .logout a {
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Coach <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>

        <div class="nav">
            <a href="manage_schedule.php">Manage Schedule</a>
            <a href="view_progress.php">View Member Progress</a>
            <a href="create_workout.php">Create Workouts</a>
        </div>

        <div class="section">
            <h3>Today's Highlights</h3>
            <p>You have <strong>3</strong> training sessions scheduled for today. Make sure to prepare your workout plans.</p>
            <p>There are <strong>5</strong> members awaiting progress updates. Keep them motivated!</p>
        </div>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
