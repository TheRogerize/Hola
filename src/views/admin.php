<?php
include "../templates/header.php";

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $role = $_SESSION['role'];
} else {
  session_destroy();
  header('Location: index.php?error=403');
  exit();
}
?>
<div class="row page-title">
  <h4>
    <i class="material-icons prefix">pending_actions</i>
    Dashboard (ADMIN)
  </h4>
</div>

<?php
include_once "../templates/welcome.php";
include_once "../templates/users-list.php";
?>
