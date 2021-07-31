<?php 
include "../../config/db.php";

if(isset($_POST['username'])) {

  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $errors = 0;
  
  if($name === '' || $username === '' || $password === '' || $role === '') {
    $errors++;
  }

  if(strlen($name) > 50 || strlen($username) > 15 || strlen($password) > 50  ) {
    $errors++;
  }

  if($errors > 0) {
    echo "The form has errors, please correct them.";
    exit();
  }

  // Checking if the user already exists
  $stmt = $conn->prepare("SELECT id FROM user WHERE username=? limit 1");
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $value = $result->fetch_object();

  if($value) {
    echo "The username is already being used";
    exit();
  }

  $stmt->close();
  $password = password_hash($password, PASSWORD_DEFAULT);

  try {
    $stmt = $conn->prepare("INSERT INTO user (name, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $password, $role);
    if($stmt->execute()) {
      echo 'success';
    }  
} catch (Exception $e) {
  echo $e->getMessage();
}
  $stmt->close();
  $conn->close();

} else {

  exit();

}
?>