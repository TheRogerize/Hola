<?php
session_start();
require('../../vendor/autoload.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../models/user.php';


$database = new Database();
$db = $database->connect();

$uname = $_POST['username'];
$pass = $_POST['password'];

$users = new User($db, $uname, $pass);

$result = $users->authUser();

$num = $result->rowCount();

if ($num > 0) {

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $user_item = array(
      'id' => $id,
      'name' => $name,
      'username' => $username,
      'hashPassword' => $password,
      'role' => $role
    );
    if (!empty($user_item)) {
      $verify = password_verify($pass, $user_item['hashPassword']);

      if ($verify) {

        $_SESSION['logged'] = 1;
        $_SESSION['id'] = $id;
        $_SESSION['user'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;

        echo json_encode($role);
      } else {

        echo json_encode(
          array("message" => "Password is incorrect")
        );
        exit();
      }
    } else {
      echo json_encode(
        array("message" => "The account does not exist.")
      );
    }
  }
} else {
  echo json_encode(
    array("message" => "¡Invalid Username/Password Combination or the account does not exist!")
  );
}
