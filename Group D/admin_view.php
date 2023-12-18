<?php 
require_once 'function.php'; // Include the function file
$connection = new Connection(); // Create a new connection object
$conn = $connection->conn; // Get the database connection
$user_id = isset($_GET['id']) ? $_GET['id'] : null; // Check if $_GET['id'] is set
$users = $conn->query("SELECT * FROM todo_list WHERE user_id = $user_id ORDER BY id DESC"); // Query to get user tasks
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Tasks</title>
</head>
<body class="custom-background">
  <div class="container py-5 h-100">
    <h1 class="text-center mb-4">To-Do List</h1>
    <div class="row mb-3">
      <div class="col">
        <h2>Administrator</h2>
      </div>
      <div class="col d-flex justify-content-end align-items-center">
      <div class="input-group search-bar">
          <input type="text" class="form-control" placeholder="Search..." id="searchInput"> <!-- Search bar -->
          <button class="btn btn-outline-secondary" type="button" style="margin-right: 10px;">Search</button>
        </div>
        <a href="admin.php" class="btn btn-secondary btn-sm">Return</a>
      </div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr class="custom-row">
          <th class="text-center">ID</th>
          <th class="text-center">Task</th>
          <th class="text-center">Date and Time</th>
          <th class="text-center">Checked</th>
          <th class="text-center">User Id</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($user = $users->fetch_assoc()): ?>
        <tr class="custom-row">
          <td class="text-center"><?=$user['id']?></td>
          <td class="text-center"><?=$user['title']?></td>
          <td class="text-center"><?=$user['date_time']?></td>
          <td class="text-center"><?=$user['checked']?></td>
          <td class="text-center"><?=$user['user_id']?></td>
          <td class="d-flex justify-content-center"><a href="admin_edit.php?id=<?=$user['id']?>" class="btn btn-primary me-2">Edit</a>
          <a href="task_delete.php?id=<?=$user['id']?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php endwhile;?>
      </tbody>
    </table>
  </div>

  <script src="js/function.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>