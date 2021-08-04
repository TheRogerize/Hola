<?php


class User
{

  private $conn;
  private $table = 'user';

  public $id;
  public $name;
  public $username;
  public $password;
  public $role;


  public function __construct($db, $username = null, $password = null)
  {
    $this->conn = $db;
    $this->username = $username;
    $this->password = $password;
  }

  // USER LOGIN
  public function authUser()
  {
    if ($this->username !== '' && $this->password !== '') {
      $query = 'SELECT id, username,
      name,
      password,
      role
      FROM user
      WHERE username = :username
      LIMIT 1';

      $stmt = $this->conn->prepare($query);
      $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
      $stmt->execute();

      return $stmt;
    } else {
      return json_encode(
        array(
          'message' => 'Please, insert your credentials.',
          'success' => false,
          )
      );
    }
  }

  // GET SINGLE USER
  public function getUser($username)
  {
    $query = 'SELECT id,
      name,
      username,
      role
      FROM ' . $this->table . '
      WHERE username = :username
      ORDER BY id DESC LIMIT 1';

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt;
  }

  // GET ALL USERS
  public function getUsers()
  {
    $query = 'SELECT id,
      name,
      username,
      role
      FROM ' . $this->table . '
      ORDER BY id DESC';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();
    return $stmt;
  }

  // CREATE NEW USER
  public function createUser($name, $username, $password, $role)
  {
    $sqlQuery = "INSERT INTO
                " . $this->table . "
            SET
                name = :name, 
                username = :username, 
                password = :password, 
                role = :role";

    $stmt = $this->conn->prepare($sqlQuery);

    $name = htmlspecialchars(strip_tags($name));
    $username = htmlspecialchars(strip_tags($username));
    $password = htmlspecialchars(strip_tags($password));
    $role = htmlspecialchars(strip_tags($role));

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":role", $role);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  // UPDATE USER
  public function updateUser($id, $name, $username, $role)
  {
    $sqlQuery = "UPDATE 
                " . $this->table . "
            SET
                name = :name, 
                username = :username, 
                role = :role
                WHERE id = :id";

    $stmt = $this->conn->prepare($sqlQuery);

    $name = htmlspecialchars(strip_tags($name));
    $username = htmlspecialchars(strip_tags($username));
    $role = htmlspecialchars(strip_tags($role));

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":role", $role);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  // DELETE USER
  public function deleteUser($id)
  {
    $sqlQuery = "DELETE FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($sqlQuery);

    $id = htmlspecialchars(strip_tags($id));

    $stmt->bindParam(1, $id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
