<?php
// Include your database connection file
include_once "connection.php"; // Update with your actual file name

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($conn)) {
    // Collect form data
    $userId = $_POST['user_id']; // Assuming user_id is passed through the form
    $newName = $_POST['new_name']; // Assuming new_name is passed through the form
    $newEmail = $_POST['new_email']; // Assuming new_email is passed through the form

    // Perform update query
    $sql = "UPDATE phone SET name = '$newName', email = '$newEmail' WHERE id = $userId";

    if (mysqli_query($conn, $sql)) {
        echo "User information updated successfully.";
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }
} else {
    echo "Error: Unable to establish database connection.";
}

// Close database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Profile</title>
</head>
<body>
    <h2>Update User Profile</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="user_id" value="123"> <!-- Assuming you have the user ID -->
        <label for="new_name">New Name:</label>
        <input type="text" name="new_name" id="new_name" required><br><br>

        <label for="new_email">New Email:</label>
        <input type="email" name="new_email" id="new_email" required><br><br>

   

        <label for="new_gender">New Gender:</label>
        <input type="gender" name="new_gender" id="new_gender" required><br><br>

        <label for="new_age">New Age:</label>
        <input type="age" name="new_age" id="new_age" required><br><br>

        <label for="new_telephone">New Telephone:</label>
        <input type="telephone" name="new_telephone" id="new_telephone" required><br><br>

        <label for="new_country">New Country:</label>
        <input type="country" name="new_country" id="new_country" required><br><br>




        <input type="submit" value="Update">
    </form>
</body>
</html>
