<?php

require 'function.php'; // Include the 'function.php' file

if (!isset($_SESSION["id"])) {
    header("Location: reglog.php"); // Redirect the user to the login/registration page if the session ID is not set
    exit;
}

$user_id = $_SESSION["id"]; // Get the user ID from the session
$userProfile = new UserManager(); // Create an instance of the UserManager class for user-related operations

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; // Get the updated username from the POST data
    $email = $_POST["email"]; // Get the updated email from the POST data
    $userProfile->updateUser($user_id, $username, $email); // Update the user's information in the database
}

$row = $userProfile->getUserInfo($user_id); // Get the user's information from the database
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/profile.css">
    <script src="js/function.js"></script>
</head>

<body>
    <div class="header">
        <h1 class="todo-logo" style="color: black;">To-Do List</h1>
        <div class="right-section">
            <a href="todo.php" style="text-decoration: none; color: black;">Back</a>
        </div>
    </div>

    <div class="container">
        <h2>Edit Profile</h2>
        <form method="post" action="">
            <input type="text" name="username" value="<?=$row["username"]?>"><br>
            <input type="email" name="email" value="<?=$row["email"]?>"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>