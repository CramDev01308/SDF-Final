<?php
session_start();

class Connection{ // Define connection parameters and initialize connection
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "todo";
  public $conn;

  public function __construct(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
}

class Register extends Connection{ // Define registration method to handle user registration
  public function registration($username, $email, $password, $confirmpassword){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
      return 10;
    }
    else{
      if($password == $confirmpassword){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users VALUES('', '$username', '$email', '$hashedPassword')";
        mysqli_query($this->conn, $query);
        return 1;
      }
      else{
        return 100;
      }
    }
  }
}

class Login extends Connection{ // Define login method to handle user login
  public $id;
  public function login($usernameemail, $password){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
      if(password_verify($password, $row["password"])){
        $_SESSION['id'] = $row["id"];
        return 1;
      }
      else{
        return 10;
      }
    }
    elseif($usernameemail == "admin" && $password == "admin"){
        header('Location:admin.php');
    }
    else{
      return 100;
    }
  }

  public function idUser(){
    return $this->id;
  }
}

class Select extends Connection{ // Define method to select user by id
  public function selectUserById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
}

class UserManager extends Connection { // Define methods to get user info and update user information
  public function getUserInfo($id){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }

  public function updateUser($id, $username, $email){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE (username = '$username' OR email = '$email') AND id != $id");
    if(mysqli_num_rows($duplicate) > 0){
      return 10; // Username or Email Has Already Taken
    }
    else{
      $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = $id";
      mysqli_query($this->conn, $query);
      return 1; // User information updated successfully
    }
  }
}