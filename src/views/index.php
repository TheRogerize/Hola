<?php
require_once "../templates/header.php";

if (isset($_SESSION['user']) && isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
  echo $role;
  if ($role === 'ADMIN') {
    header("Location: admin.php");
  } else if ($role === 'PAGE_1') {
    header("Location: ../views/page_1.php");
  } else if ($role === 'PAGE_2') {
    header("Location: ../views/page_2.php");
  }
}
?>
<div class="container login-container center-align center">
  <div class="login-header grey-text text-darken-3">
    Log In
  </div>
  <div class="card-panel login-form">
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input placeholder="Username" id="username" type="text" class="validate">
            <label for="username">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock</i>
            <input id="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <blockquote class="red-text darken-2" id="login-msg">
          </blockquote>
          <?php
          if (isset($_GET['error'])) {
          ?>
            <blockquote class="red-text darken-2" id="login-msg">
              Oops, error 403 <br />
              You are unable to access that page, please try to log in first
            </blockquote>
          <?php
          }
          ?>
        </div>
        <?php if (!isset($_SESSION['user'])) { ?>
          <button class="btn waves-effect waves-light" type="button" name="action" onclick="login()">Log in
            <i class="material-icons right">send</i>
          </button>
        <?php } ?>
      </form>
    </div>
  </div>
</div>
</div>