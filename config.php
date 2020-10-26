<?php
$servername   = "localhost";

// final server
<<<<<<< HEAD
$database = "llumipunts";
$username = "myllumipun";
$password = "S141354W";
=======
//  $database = "llumipunts";
//  $username = "myllumipun";
//  $password = "S141354W";
>>>>>>> 81b6c8d2ca3c04cce3fc83f2a34c1b6f01e6762f

// aurel local server
$database = "qrs";
$username = "root";
$password = "root";

//jordis local server
//$database = "qrs";
//$username = "root";
//$password = "";

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
 // echo "Connected successfully";
?>


