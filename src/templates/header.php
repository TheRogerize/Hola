<?php
session_start();
if (isset($_SESSION['user'])) {

  $duration = (5 * 60);

  if (isset($_SESSION['started'])) {

    $time = ($duration - (time() - $_SESSION['started']));

    if ($time <= 0) {

      unset($_SESSION['user']);
      unset($_SESSION['role']);
      session_destroy();
    } else {
      $_SESSION['started'] = time();
    }
  }

  $user = $_SESSION['user'];
  $role = $_SESSION['role'];
  $_SESSION['START'] = time();
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="hola icon" href="../../resources/assets/favicon.ico" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="../../resources/css/styles.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>¡HolaDevs!</title>
</head>

<body>
  <nav>
    <div class="nav-wrapper red-hola">
      <a href="../views/index.php" class="brand-logo center">
        <img class="ml-5 " height="64px" src="../../resources/assets/logo.png">
      </a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">

        <?= !isset($user) ?
          '<li><a href="../views/index.php">Log In</a></li>' : '' ?>
        <?php
        if (isset($role) && $role === "ADMIN") {
        ?>
          <li><a href="../views/page_1.php">Page 1</a></li>
          <li><a href="../views/page_2.php">Page 2</a></li>
        <?php } else { ?>
          <?= $role === 'PAGE_1' ?
            '<li><a href="../views/page_1.php">Page 1</a></li>' : '<li><a href="../views/page_2.php">Page 2</a></li>' ?>
        <?php  } ?>
        <?= isset($user) ?
          '<li class="logout"><a href="../controllers/logout.php">Log Out</a><i class="material-icons logout-icon prefix">power_settings_new</i></li>' : '' ?>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <?php if (isset($user)) {
      if (isset($role) && $role === "ADMIN") {
    ?>
        <li><a href="../views/page_1.php">Page 1</a></li>
        <li><a href="../views/page_2.php">Page 2</a></li>
      <?php } else { ?>
        <?= $role === 'PAGE_1' ?
          '<li><a href="../views/page_1.php">Page 1</a></li>' : '<li><a href="../views/page_2.php">Page 2</a></li>' ?>
      <?php  } ?>
      <?= isset($user) ?
        '<li class="logout"><a href="../controllers/logout.php">Log Out <i class="material-icons logout-icon prefix">power_settings_new</i></a></li>' : '' ?>
    <?php } else {  ?>
      <li><a href="../views/index.php">Log In</a></li>
    <?php } ?>
  </ul>
  <script type="text/javascript" src="../../resources/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
  <script type="text/javascript" src="../../resources/js/scripts.js"></script>

</body>

</html>

<?php
?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
  });

  // Or with jQuery

  $(document).ready(function() {
    $('.sidenav').sidenav();
  });
</script>