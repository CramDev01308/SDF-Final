<?php

if(isset($_POST['id'])){
    require '../db_conn.php'; // Connect to the database

    $id = $_POST['id']; // Get the ID from the form

    if(empty($id)){
       echo 0; // Output 0 if ID is empty
    }else {
        $stmt = $conn->prepare("DELETE FROM todo_list WHERE id=?"); // Prepare SQL statement to delete task by ID
        $res = $stmt->execute([$id]); // Execute the SQL statement with the ID

        if($res){
            echo 1; // Output 1 if deletion is successful
        }else {
            echo 0; // Output 0 if deletion fails
        }
        $conn = null; // Close the database connection
        exit(); // Exit the script
    }
}else {
    header("Location: ../todo.php?mess=error"); // Redirect with error message if ID is not set
}