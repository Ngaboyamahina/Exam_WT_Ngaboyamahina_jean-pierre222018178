<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = ($_POST['user_name']);
    $password = ($_POST['password']);

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM phone WHERE user_name = ? LIMIT 1");
        $stmt->bind_param("s", $user_name); // Bind parameters
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();
            // Verify password using password_verify function
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id']; // Corrected session variable
                header("location:index.php");
                die();
            } else {
                echo "Wrong password";
            }
        } else {
            echo "Wrong username";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> 
    <style type="text/css">
        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border-color: blue;
            width: 100%;
        }

        #button {
            padding: 10px;
            width: 100px;
            color: white;
            background-color: goldenrod;
        }
        #button:hover{
        background-color: red;
        }

        #box {
            background-color: chartreuse;
            margin: auto;
            width: 300px;
            padding: 20px;
            background-image: url(Intore.gif);
        }
        
    </style>
</head>
<body>
<h>welcome to the website
    this is website of
    of art and handcraft
    </h>
    <div class="rev">
        
    </div>
    
    <div id="box">
    
        <form method="POST">
            <div style="font-size:20px; margin:10px; color: blue;">please fill form below to login</div>
            <div style="font-size:20px; margin:10px; color: blue;">username</div>
            <input id="username" type="text" name="user_name"><br><br>
            <div style="font-size:20px; margin:10px; color: blue;">password</div>
            <input id="user_password" type="password" name="password"><br><br>
            <input id="button" type="submit" value="Login"><br><br>
            <a href="signup.php">Click to register</a><br><br>
        </form>
        
    </div>
</body>
</html>
