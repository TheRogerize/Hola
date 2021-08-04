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
  isset($_POST['id']) &&
  isset($_POST['name']) &&
  isset($_POST['username']) &&
  isset($_POST['role'])
) {

  $id = $_POST['id'];
  $name = $_POST['name'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $errors = 0;

  if ($id === '' || $name === '' || $username === '' || $role === '') {
    $errors++;
  }

  if (strlen($name) > 50 || strlen($username) > 15 ) {
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

  $updateUser = $user->updateUser($id, $name, $username, $role);
  if ($updateUser) {

    echo json_encode(
      array(
        "message" => "¡The user was succesfully updated!",
        "success" => true
      )
    );
  } else {
    echo json_encode(
      array(
        "message" => "There was an error in the server and
        the user could not be updated, please try again.",
        "success" => false
      )
    );
  }
} else {
  echo json_encode(
    array(
      "message" => "The user could not be updated because there is missing data.",
      "success" => false
    )
  );
  exit();
}