<?php
require('config.php');
include('lang.php');
//Create variables
$name = $_POST['name'];
$email = $_POST['password'];
$query = mysqli_query($conn,"SELECT * FROM `users` WHERE `mail`='$email' AND `name`='$name'");
$queryName = mysqli_query($conn,"SELECT * FROM `users` WHERE  `name`='$name'");
$sql = "INSERT INTO `users`(`name`, `mail`) VALUES ('$name', '$email')";

//Checking to see if user already exist
if(mysqli_num_rows($queryName) > 0 && mysqli_num_rows($query) < 1) {
    die ($copy["form:msg:taken"]); 
}
else if(mysqli_num_rows($query) > 0) {
   while ($row = $query->fetch_assoc()) {
        setcookie('userId',$row['id'],time() + (86400 * 90), "/");
        setcookie('name',$row['name'],time() + (86400 * 90), "/");
        setcookie('points', $row['points'],time() + (86400 * 90), "/");
   }
   echo "return";
}
else if(!mysqli_query($conn, $sql)) {
    echo 'Error';
}
else {
    $sql_id= "SELECT `id` FROM `users` WHERE `mail`='$email'";
    $result= mysqli_query($conn, $sql_id);
    while ($row = $result->fetch_assoc()) {
        $userId= $row['id'];
    }
    setcookie('userId', $userId,time() + (86400 * 90), "/");
    setcookie('name', $name,time() + (86400 * 90), "/");
    setcookie('points', "0",time() + (86400 * 90), "/");
    //Create an empty database of qr codes
    $query2 = mysqli_query($conn,"INSERT INTO `codes`(`id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`) VALUES ('$userId',0,0,0,0,0,0,0,0,0,0)");
    echo "success";
}

//Close connection
mysqli_close($conn);

?>