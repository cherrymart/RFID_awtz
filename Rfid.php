<?php

class Rfid {

  private $conn;

  public function __construct($conn) { 
    $this->conn = $conn;
  }

  public function getUsers () {

    $sql = "SELECT * FROM users";

    $res = $this->conn->query($sql);

    $result = [];

    while ($row = $res->fetch_assoc()) {
      $result[] = $row;
    }

    return $result;

  }

  public function formatDate($date) {

    if ($date == null)
      return "";

    return date("M d, Y G:i A", strtotime($date));

  }

  public function displayRow($row) {
    
    $r = "<tr>";
    $r .= "<td>{$row['rfid_number']}</td>";
    $r .= "<td>{$row['fullname']}</td>";
    $r .= "<td>{$row['parents_number']}</td>";
    $r .= "<td>" . $this->formatDate($row['time_in']) . "</td>";
    $r .= "<td>" . $this->formatDate($row['time_out']) . "</td>";

    return $r;
  }

  public function insertUser($post) {

    extract($post, EXTR_OVERWRITE);

    $sql = "INSERT INTO 
             users (rfid_number, fullname, parents_number)
            VALUES
             ('$rfid_number', '$fullname', '$parents_number')";

    if ($this->conn->query($sql))
      return 'inserted';
    else
      return 'error';
    
  }
  
}