<?php
session_start();
include("connection.php");
include("functions.php");

// Function to fetch all users from the database
function fetchUsers($con) {
    $query = "SELECT * FROM phone";
    $result = mysqli_query($con, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $users;
}

// Delete user if delete button is clicked
if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $query = "DELETE FROM phone WHERE user_id='$delete_id'";
    mysqli_query($con, $query);
    header("Location: ".$_SERVER['PHP_SELF']);
    die;
}

// Fetch users
$users = fetchUsers($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <style type="text/css">
        /* CSS styles */
    </style>
</head>
<body>
    <!-- Table to display registered users -->
    <table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Telephone</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['user_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['gender']; ?></td>
                    <td><?php echo $user['age']; ?></td>
                    <td><?php echo $user['telephone']; ?></td>
                    <td><?php echo $user['country']; ?></td>
                    <td>
                        <!-- Delete button -->
                        <a href="?delete=<?php echo $user['user_id']; ?>">Delete</a> |
                        <!-- Update button -->
                        <a href="update.php?user_id=<?php echo $user['user_id']; ?>">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="box">
        <!-- Registration form -->
        <form method="POST">
            <!-- Form fields -->
        </form>
    </div>
</body>
</html>
