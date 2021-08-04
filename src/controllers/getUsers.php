<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->connect();

$users = new User($db, null, null);

$result = $users->getUsers();

$num = $result->rowCount();

if($num > 0) {
  $users_arr = array();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $user_item = array(
      'id' => $id,
      'name' => $name,
      'username' => $username,
      'role' => $role
    );

    array_push($users_arr, $user_item);

  }

  echo json_encode($users_arr);
} else {

  echo json_encode(
    array('message' => 'No users found')
  );
}
