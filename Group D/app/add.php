<?php
session_start();

if(isset($_POST['title'])){
    require '../db_conn.php'; // Connect to the database

    $user_id = $_SESSION['id']; // Get the user's ID from the session
    $title = $_POST['title']; // Get the title from the form

    if(empty($title)){
        header("Location: ../todo.php?mess=error"); // Redirect with error message if title is empty
    }else {
        $stmt = $conn->prepare("INSERT INTO todo_list(title,user_id) VALUE(?,?)"); // Prepare SQL statement for inserting title and user ID into todo_list table
        $res = $stmt->execute([$title,$user_id]); // Execute the SQL statement with title and user ID

        if($res){
            header("Location: ../todo.php?mess=success");  // Redirect with success message if insertion is successful
        }else {
            header("Location: ../todo.php"); // Redirect without message if insertion fails
        }
        $conn = null; // Close the database connection
        exit(); // Exit the script
    }
}else {
    header("Location: ../todo.php?mess=error"); // Redirect with error message if title is not set
}