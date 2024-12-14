<?php
session_start();
require 'db_connection.php'; // Include your database connection

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle deletion form submission
$delete_message = ""; // Feedback message for the admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']); // Sanitize the user ID

    // Prevent admin from deleting their own account
    if ($user_id == $_SESSION['user_id']) {
        $delete_message = "You cannot delete your own account.";
    } else {
        // Execute the delete query
        $stmt = $conn->prepare("DELETE FROM signup WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $delete_message = "User deleted successfully.";
        } else {
            $delete_message = "Error deleting user: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch all users for the dropdown
$sql = "SELECT id, name, email FROM signup";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        select, button {
            margin-bottom: 1rem;
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #dc3545;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c82333;
        }

        .message {
            font-size: 1rem;
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>

        <!-- Feedback message -->
        <?php if (!empty($delete_message)): ?>
            <div class="<?php echo strpos($delete_message, 'Error') !== false ? 'error' : 'message'; ?>">
                <?php echo $delete_message; ?>
            </div>
        <?php endif; ?>

        <form action="delete_user.php" method="POST">
            <label for="user_id">Select User to Delete:</label>
            <select name="user_id" id="user_id" required>
                <option value="" disabled selected>Choose a user</option>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['name'] . " (" . $row['email'] . ")"); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="">No users found</option>
                <?php endif; ?>
            </select>

            <button type="submit">Delete User</button>
        </form>
    </div>
</body>
</html>
