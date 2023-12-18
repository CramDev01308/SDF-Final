<?php
require_once 'function.php';

$connection = new Connection();
$conn = $connection->conn;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Delete the task with the given ID
  $sql = "DELETE FROM todo_list WHERE id=$id";
  $conn->query($sql);
  
  // Check if the task was successfully deleted
  if ($conn->affected_rows > 0) {
    header('location:admin.php');
  }
}
?>