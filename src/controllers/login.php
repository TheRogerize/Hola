<?php
include "../../config/db.php";

$uname = $_POST['username'];
$password = $_POST['password'];

if ($uname != "" && $password != "") {

  $stmt = $conn->prepare("SELECT id, username, name, password, role FROM user WHERE username=? LIMIT 1");
  $stmt->bind_param('s', $uname);
  $stmt->execute();
  $stmt->bind_result($id, $username, $name, $hashPassword, $role);
  $stmt->store_result();

  if ($stmt->num_rows == 1) {

    if ($stmt->fetch()) {

      $verify = password_verify($password, $hashPassword);

      if ($verify) {

        $_SESSION['logged'] = 1;
        $_SESSION['id'] = $id;
        $_SESSION['user'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;

        echo $role;
      } else {

        echo "Password is incorrect";
        exit();
      }
    } else {
      echo "The account does not exist.";
    }

    $stmt->close();
  }
} else {
  echo "¡Invalid Username/Password Combination!";
}
