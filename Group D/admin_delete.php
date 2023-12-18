<?php
 require_once 'function.php'; // Include the function file

 $connection = new Connection(); // Create a new connection object
 $conn = $connection->conn; // Get the database connection

   if(isset($_GET['id'])){ // If ID is set in the URL
    $id = $_GET['id']; // Get the ID from the URL
    $sql = "DELETE FROM todo_list WHERE user_id=$id"; // Delete tasks associated with the user
    $conn->query($sql); // Execute the SQL query to delete tasks
    $sql = "DELETE FROM users WHERE id=$id"; // Delete the user

    if ($conn->query($sql) === TRUE) { // If the SQL query is executed successfully
      header('location:admin.php'); // Redirect to admin page
    }
}
?>