<?php 

class Database {
  public $conn;

  public function __construct($db, $host, $username, $password) {

    $this->conn = new mysqli($host, $username, $password, $db);
    $this->conn->set_charset('utf8');
    
  }

  public function getConnection () {    
    return $this->conn;
  }

}