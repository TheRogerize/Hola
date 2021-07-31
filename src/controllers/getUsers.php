<?php

$sql = "SELECT id, name, username, role FROM user ORDER BY id DESC";
$result = $conn->query($sql);
?>
<?php
if ($role === 'ADMIN') {
?>
  <div class="user-list">
    <a class="waves-effect waves-light btn-large add-button modal-trigger" href="#newUser"><i class="material-icons right">add</i>New User</a>
    <div id="newUser" class="modal modal-size">
      <div class="modal-content">
        <h4>New User</h4>
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <input placeholder="e.g: Roy Gutierrez" id="fullname" type="text" class="validate" data-length="50">
                <label for="fullname">Fullname</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" class="validate" data-length="15">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" class="validate" data-length="50">
                <label for="password">Password</label>
              </div>
            </div>
            <div class="input-field col s12">
              <select id="role">
                <option value="" disabled selected>Choose a role</option>
                <option value="ADMIN">ADMIN</option>
                <option value="PAGE_1">PAGE_1</option>
                <option value="PAGE_2">PAGE_2</option>
              </select>
              <label>Role</label>
            </div>
        </div>

        <blockquote class="red-text darken-2" id="add-user-msg">
        </blockquote>
      </div>
      <div class="modal-footer">
        <a onclick="addUser()" class="waves-effect waves-green btn-flat teal darken-1 white-text">Add</a>
      </div>
    </div>

    <div id="updateUser" class="modal updateUser modal-size">
      <div class="modal-content">
        <h4>Update User</h4>
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <input id="editname" placeholder=" " type="text" class="validate" data-length="50">
                <label for="editname">Fullname</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="editusername" placeholder=" " type="text" class="validate" data-length="15">
                <label for="editusername">Username</label>
              </div>
            </div>
            <div class="input-field col s12">
              <select id="editrole">
                <option value="" disabled selected>Choose a role</option>
                <option value="ADMIN">ADMIN</option>
                <option value="PAGE_1">PAGE_1</option>
                <option value="PAGE_2">PAGE_2</option>
              </select>
              <label for="editrole">Role</label>
            </div>
        </div>

        <blockquote class="red-text darken-2" id="update-msg">
        </blockquote>
      </div>
      <div class="modal-footer">
        <a onclick="updateUser()" class="waves-effect waves-green btn-flat teal darken-1 white-text">Update</a>
      </div>
    </div>
  <?php
}
if ($result->num_rows > 0) {
  ?>

    <ul class="collection user-list">
      <?php
      while ($row = $result->fetch_assoc()) {
      ?>
        <li class="collection-item avatar" id="user<?= $row['id']; ?>" name="<?= $row['name']; ?>" username="<?= $row['username']; ?>" role="<?= $row['role']; ?>">
          <!-- <img src="images/yuna.jpg" alt="" class="circle"> -->
          <span class="title"><?= $row['username']; ?></span>
          <p><?= $row['name']; ?> <br>
            <small><?= $row['role']; ?> </small>
          </p>
          <?php
          if ($role === 'ADMIN') {
          ?>
            <div class="menu-options">
              <div class="option">
                <button class="yellow-text darken-1 modal-trigger" href="#updateUser" data-target="updateUser" onclick="editUser(<?= $row['id']; ?>)">
                  <i class="material-icons">edit</i></button>
              </div>
              <div class="option">
                <a href="#!" class="red-text" onclick="deleteUser(<?= $row['id']; ?>, '<?= $row['name']; ?>')"><i class="material-icons">delete</i></a>
              </div>
            </div>
          <?php
          }
          ?>
        </li>
      <?php
      }
      ?>
    </ul>
  </div>

<?php
} else {
?>
  <ul class="collection user-list">
    <li class="collection-item avatar">
      <span class="title">No se han encontrado usuarios.</span>
    </li>
  </ul>
<?php
}
?>
</div>
<script>
  $(document).ready(function() {
    $('input#fullname, input#password, input#username').characterCounter();
    $('input#editname, input#editusername, input#editrole').characterCounter();
    $('.modal').modal({
      onCloseEnd: function() {
        $('input#fullname, input#password, input#username').val('')
        $("select#role").val('').change();
      }
    });
    $('.updateUser').modal({
      onCloseEnd: function() {
        $('input#editname, input#editusername').val('');
        $("select#editrole").val('').change();

      }
    });
    $('select').formSelect();
  });
</script>