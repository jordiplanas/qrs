<?php
$servername   = "localhost";

// local server
$database = "qrs";
$username = "root";
$password = "root";

// vimod server
// $database = "codesqr";
// $username = "myvimod68";
// $password = "eo25m3pq";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully";
?>


