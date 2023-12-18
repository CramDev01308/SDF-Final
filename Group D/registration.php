<?php
require 'function.php'; // Include the function file

if(!empty($_SESSION["id"])){
  header("Location: login.php"); // Redirect to login.php if session id is not empty
}

$register = new Register(); // Create a new Register object

if(isset($_POST["submit"])){
  $result = $register->registration($_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]); // Call the registration method

  if($result == 1){
    echo "<script> alert('Registration Successful'); </script>"; // Show alert for successful registration
  }
  elseif($result == 10){
    echo "<script> alert('Username or Email Has Already Taken'); </script>"; // Show alert for existing username or email
  }
  elseif($result == 100){
    echo "<script> alert('Password Does Not Match'); </script>"; // Show alert for password mismatch
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
</head>

<body>
    <div class="wrapper">
        <form class="" action="" method="post" autocomplete="off">
            <h1>Registration</h1>
            <div class="input-box">
                <input type="text" name="username" class="input-field" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <input type="text" name="email" class="input-field" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" required>
                <label>Password</label>
            </div>
            <div class="input-box">
                <input type="password" name="confirmpassword" class="input-field" required>
                <label>Confirm Password</label>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>