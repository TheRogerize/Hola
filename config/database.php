<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  class Database
  {
    private $host = "localhost";
    private $db_name = "hola_test";
    private $username = "root";
    private $password = "";
    private $conn;

  public function connect() 
  {
    $this->conn = null;

    try { 
      $this->conn= new PDO('mysql:host=' . $this->host . ';dbname=' .  $this->db_name,
      $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}
?>