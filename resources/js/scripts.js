function login() {
  const username = $("#username").val().trim();
  const password = $("#password").val().trim();
  if (username != "" && password != "") {
    $("#login-msg").html("");
    $.ajax({
      type: "POST",
      url: "../../src/controllers/login.php",
      data: { username: username, password: password },
      success: function (response) {
        var msg = "";
        msg = "Loggin in...";
        switch (response) {
          case "ADMIN":
            window.location = "../../src/views/admin.php";
            break;

          case "PAGE_1":
            window.location = "../../src/views/page_1.php";
            break;

          case "PAGE_2":
            window.location = "../../src/views/page_2.php";
            break;

          default:
            msg = response;
            $("#login-msg").html(msg);
            break;
        }
      },
    });
  } else {
    $("#login-msg").html("Please, enter your username and password");
  }
}

function validateForm(user) {
  let errors = 0;
  if (
    user.name == "" ||
    user.username == "" ||
    user.password == "" ||
    user.role == ""
  ) {
    $("#add-user-msg").html("Please, make sure to complete all of the fields.");
    errors++;
  }

  if (
    user.name.length > 50 ||
    user.username.length > 15 ||
    user.password.length > 50
  ) {
    errors++;
    $("#add-user-msg").html("There are errors in the form.");
  }
  return errors > 0 ? false : true;
}

function validateUpdate(user) {
  let errors = 0;
  if (user.name == "" || user.username == "" || user.role == "") {
    $("#update-msg").html("Please, make sure to complete all of the fields.");
    errors++;
  }
  if (user.name.length > 50 || user.username.length > 15) {
    errors++;
    $("#update-msg").html("There are errors in the form.");
  }
  return errors > 0 ? false : true;
}

function addUser() {
  let user = {
    name: "",
    username: "",
    password: "",
    role: "",
  };

  user.name = $("#fullname").val();
  user.username = $("#username").val();
  user.password = $("#password").val();
  user.role = $("#role").val();
  if (validateForm(user)) {
    $.ajax({
      url: "../../src/controllers/createUser.php",
      type: "POST",
      data: {
        name: user.name,
        username: user.username,
        password: user.password,
        role: user.role,
      },
      success: function (response) {
        if (response === "success") {
          $("#newUser").fadeOut(1000);
          let toastHTML = `<span>¡${user.username} was created succesfully! ✅</span>`;
          M.toast({ html: toastHTML });
          setTimeout(() => {
            location.reload();
          }, 1400);
        } else {
          $("#add-user-msg").html(response);
        }
      },
    });
  }
}

function editUser(id) {
  let user = {
    name: "",
    username: "",
    role: "",
  };

  user.name = $("li#user" + id).attr("name");
  user.username = $("li#user" + id).attr("username");
  user.role = $("li#user" + id).attr("role");

  $("input#editname").val(user.name);
  $("input#editusername").val(user.username);
  $("select#editrole").val(user.role).change();
}

function updateUser() {
  let user = {
    name: "",
    username: "",
    role: "",
  };

  user.name = $("#editname").val();
  user.username = $("#editusername").val();
  user.role = $("#editrole").val();
  if (validateUpdate(user)) {
    $.ajax({
      url: "../../src/controllers/updateUser.php",
      type: "POST",
      data: {
        name: user.name,
        username: user.username,
        role: user.role,
      },
      success: function (response) {
        if (response === "success") {
          $("#updateUser").fadeOut(1000);
          let toastHTML = `<span>¡${user.username} was updated succesfully! ✅</span>`;
          M.toast({ html: toastHTML });
          setTimeout(() => {
            location.reload();
          }, 1400);
        } else {
          $("#update-msg").html(response);
        }
      },
    });
  }
}

function deleteUser(id, name) {
  if (confirm(`Are you sure you want to delete ${name}?`)) {
    $.ajax({
      url: "../../src/controllers/deleteUser.php",
      type: "POST",
      data: { user_id: id },
      success: function (res) {
        let toastHTML = "";

        if (res === "success") {
          toastHTML = `<span>¡${name} was deleted succesfully! ✅</span>`;
          M.toast({ html: toastHTML });
          setTimeout(() => {
            location.reload();
          }, 1400);
        } else {
          toastHTML = `<span>${res}</button>`;
          M.toast({ html: toastHTML });
        }
      },
    });
  }
}
