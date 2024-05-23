<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $user_id = $_SESSION['user_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];
    $country = $_POST['country'];

    // Update user information in the database
    $query = "UPDATE phone SET user_name='$user_name', email='$email', gender='$gender', age='$age', telephone='$telephone', country='$country' WHERE user_id='$user_id'";
    mysqli_query($con, $query);

    // Redirect back to the profile page or any other desired location
    header("Location: profile.php");
    exit();
}

// Fetch the user's current information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM phone WHERE user_id='$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style type="text/css">
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h2>Update Profile</h2>
    <form method="POST">
        <div>
            <label for="user_name">Username:</label>
            <input type="text" id="user_name" name="user_name" value="<?php echo $user['user_name']; ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">
        </div>
        <div>
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo $user['gender']; ?>">
        </div>
        <div>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $user['age']; ?>">
        </div>
        <div>
            <label for="telephone">Telephone:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $user['telephone']; ?>">
        </div>
        <div>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="<?php echo $user['country']; ?>">
        </div>
        <button type="submit">Update</button>
    </form>
</body>
</html>
