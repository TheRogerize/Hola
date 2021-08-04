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



if(isset($_POST['user_id'])) {
  $result = $user->deleteUser($_POST['user_id']);


  if($result) {

    echo json_encode(
      array(
        "message" => "The user has been succesfully deleted.",
        "success" => true
      )
      );

  } else {
    
    echo json_encode(
      array(
        "message" => "There was an error and the user could not be deleted.",
        "success" => false
      )
    );
  }
} else {
  echo json_encode(
    array(
      "message" => "You haven't selected any user.",
      "success" => false
    )
  );
}

exit();
?>