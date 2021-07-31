<?php 
include "../../config/db.php";

if(isset($_POST['username'])) {

  $name = $_POST['name'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $errors = 0;
  if($name === '' || $username === '' || $role === '') {
    $errors++;
  }
  if(strlen($name) > 50 || strlen($username) > 15) {
    $errors++;
  }

  if($errors > 0) {
    echo "The form has errors, please correct them.";
    exit();
  }

  try {
    $stmt = $conn->prepare("UPDATE user SET name = ?, username = ?, role = ? WHERE username = ?");
    $stmt->bind_param("ssss", $name, $username, $role, $username);
    if($stmt->execute()) {
      echo 'success';
    }  
    $stmt->close();
} catch (Exception $e) {
  echo $e->getMessage();
}
  $conn->close();

} else {

  exit();

}
?>