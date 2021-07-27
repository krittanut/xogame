<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xogame";

// echo "Test  " .$_GET['win'] ."move : " . $_GET['move'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO game_1 (win, size,move)
VALUES (" . $_GET['win'] . "," . $_GET['size'] . "," . "'" . $_GET['move'] . "')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script>window.close()</script>
