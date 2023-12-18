<?php 
 require_once 'function.php'; // Include the function file

 $connection = new Connection(); // Create a new connection object
 $conn = $connection->conn; // Get the database connection

 $users = $conn->query("SELECT * FROM users ORDER BY id ASC"); // Query to get all users
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="icon" href="img/Todo.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Administrator</title>
</head>

<body class="custom-background">
  <div class="container py-5 h-100">
    <h1 class="text-center mb-4">To-Do List</h1>
    <div class="row mb-3">
      <div class="col">
        <h2>Users List</h2>
      </div>
      <div class="col d-flex justify-content-end align-items-center">
        <div class="input-group search-bar">
          <input type="text" class="form-control" placeholder="Search..." id="searchInput">
          <button class="btn btn-outline-secondary" type="button">Search</button>
        </div>
        <a href="logout.php" class="btn btn-secondary btn-sm ms-2">Logout</a>
      </div>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr class="custom-row">
          <th class="text-center">ID</th>
          <th class="text-center">Username</th>
          <th class="text-center">Email</th>
          <th class="text-center">Password</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($user = $users->fetch_assoc()): ?>
        <tr class="custom-row">
          <td class="text-center"><?=$user['id']?></td>
          <td class="text-center"><?=$user['username']?></td>
          <td class="text-center"><?=$user['email']?></td>
          <td class="text-center"><?=$user['password']?></td>
          <td class="d-flex justify-content-center">
            <a href="admin_view.php?id=<?=$user['id']?>" class="btn btn-primary me-2">View</a><a href="admin_delete.php?id=<?=$user['id']?>" class="btn btn-danger">Delete</a>
          </td>
        <?php endwhile;?>
      </tbody>
    </table>
  </div>
  <script src="js/function.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>