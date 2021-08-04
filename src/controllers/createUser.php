<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('../../vendor/autoload.php');

include_once '../../config/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->connect();

$user = new User($db, null, null);

if (
  isset($_POST['name']) &&
  isset($_POST['username']) &&
  isset($_POST['password']) &&
  isset($_POST['role'])
) {

  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $errors = 0;

  if ($name === '' || $username === '' || $password === '' || $role === '') {
    $errors++;
  }

  if (strlen($name) > 50 || strlen($username) > 15 || strlen($password) > 50) {
    $errors++;
  }

  if ($errors > 0) {
    echo json_encode(
      array(
        "message" => "The form has errors, please correct them.",
        "success" => false
      )
    );
    exit();
  }

  $userExists = $user->getUser($username);
  $dataRow = $userExists->fetch(PDO::FETCH_ASSOC);
  if ($dataRow) {
    echo json_encode(
      array(
        "message" => "This user already exists.",
        "success" => false
      )
    );
    exit();
  }

  $password = password_hash($password, PASSWORD_DEFAULT);
  $createUser = $user->createUser($name, $username, $password, $role);
  if ($createUser) {

    echo json_encode(
      array(
        "message" => "¡The user was succesfully created!",
        "success" => true
      )
    );
  } else {
    echo json_encode(
      array(
        "message" => "There was an error in the server and
        the user could not be created, please try again.",
        "success" => false
      )
    );
  }
} else {
  echo json_encode(
    array(
      "message" => "The user could not be created because there is missing data.",
      "success" => false
    )
  );
  exit();
}
