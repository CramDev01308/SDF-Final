<?php
require 'function.php';
$_SESSION = []; // Clear the session data
session_unset(); // Unset all of the session variables
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to login.php
?>