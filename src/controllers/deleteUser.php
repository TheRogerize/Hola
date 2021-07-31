<?php 
include "../../config/db.php";

if(isset($_POST['user_id'])) {

  $query = $conn->prepare("DELETE FROM user WHERE id=?");
  $query->bind_param('i', $_POST['user_id']);

  if($query->execute()) {

    echo 'success';

  } else {
    
    echo 'There was an error and the user could not be deleted';
    
  }
  
$query->close();
}
?>