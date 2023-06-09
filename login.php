<?php
include 'config/db.php';
include 'Rfid.php';

$db = new Database("rfid", "localhost", "root", "");

$conn = $db->getConnection();

$rfid = new Rfid($conn);

if (!empty($_POST)) {
  $rfid->insertUser($_POST);
}

$users = $rfid->getUsers();

// echo debug($users);

function debug($d) {
  echo "<pre>" . print_r($d, true) . "</pre>";
}

?>

<!DOCTYPE html>
<html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>RFID</title>
</head>

<body>

  <div class="container-sm">

    <nav class="navbar" style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add
          Students</button>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

          <a class="btn btn-primary" href="index.php">Logout</a>
        </form>
      </div>
    </nav>

    <div style="margin-top: 5%;">
      <table class="table">
        <thead class="bg-primary">
          <tr>
            <th scope="col">RFID #</th>
            <th scope="col">Full Name</th>
            <th scope="col">Gurdians Contact No.</th>
            <th scope="col">Time In</th>
            <th scope="col">Time Out</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php 
            if (!empty($users))
              foreach ($users as $user)
                echo $rfid->displayRow($user);          
          ?>
        </tbody>
      </table>

    </div>


  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="add_user" method="POST" action="login.php">
          <div class="modal-body">
            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing-sm">RFID NUMBER</span>

              <input name="rfid_number" type="text" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing-sm">Student Name</span>

              <input name="fullname" type="text" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" id="inputGroup-sizing-sm">Guardian No.</span>

              <input name="parents_number" type="text" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>

</body>

</html>