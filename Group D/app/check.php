<?php

if(isset($_POST['id'])){
    require '../db_conn.php'; // Connect to the database

    $id = $_POST['id']; // Get the ID from the form

    if(empty($id)){
       echo 'error'; // Output 'error' if ID is empty
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todo_list WHERE id=?"); // Prepare SQL statement to select ID and checked status from todo_list
        $todos->execute([$id]); // Execute the SQL statement with the ID

        $todo = $todos->fetch(); // Fetch the result
        $uId = $todo['id']; // Get the ID from the result
        $checked = $todo['checked']; // Get the checked status from the result

        $uChecked = $checked ? 0 : 1; // Toggle the checked status

        $res = $conn->query("UPDATE todo_list SET checked=$uChecked WHERE id=$uId"); // Update the checked status in todo_list

        if($res){
            echo $checked; // Output the previous checked status
        }else {
            echo "error"; // Output 'error' if update fails
        }
        $conn = null; // Close the database connection
        exit(); // Exit the script
    }
}else {
    header("Location: ../todo.php?mess=error"); // Redirect with error message if ID is not set
}