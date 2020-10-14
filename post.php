<?php
require('config.php');
//Create variables
$name = $_POST['name'];
$email = $_POST['email'];
$query = mysqli_query($conn,"SELECT * FROM `users` WHERE `mail`='$email'");
$sql = "INSERT INTO `users`(`name`, `mail`) VALUES ('$name', '$email')";

//Make sure name is valid
if(!preg_match("/^[a-zA-Z'-]+$/",$name)) { 
    die (" invalid first name");
}
//make sure user checked
if(!isset($_POST['privacy'])){
    die (" Please check privacy"); 
}
//Response
//Checking to see if email already exsist
if(mysqli_num_rows($query) > 0) {
    echo "The email, " . $_POST['email'] . ", already exists.";
}
else if(!mysqli_query($conn, $sql)) {
    echo 'Could not insert';
}
else {
    $sql_id= "SELECT `id` FROM `users` WHERE `mail`='$email'";
    $result= mysqli_query($conn, $sql_id);
    while ($row = $result->fetch_assoc()) {
        $userId= $row['id'];
    }
    setcookie('userId', $userId);
    setcookie('name', $name);
    setcookie('points', "0");
    echo "Thank you, " . $_POST['name'] . ". Your information has been inserted.";
    echo "Your id : " . $userId;
    //Create an empty database of qr codes
    $query2 = mysqli_query($conn,"INSERT INTO `codes`(`id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`) VALUES ('$userId',0,0,0,0,0,0,0,0,0,0)");
}

//Close connection
mysqli_close($conn);

?>