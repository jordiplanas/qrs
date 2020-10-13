<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>qrs</title>
  <meta name="description" content="qrs">
  <meta name="author" content="Jordi">
</head>
<body>
<?php
require('config.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['name']) && isset($_REQUEST['privacy'])){
    $username = stripslashes($_REQUEST['name']);
    $username = mysqli_real_escape_string($conn,$username); 
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn,$email);
    $sql_e = "SELECT * FROM `users` WHERE `mail`='$email'";
    $sql_u = "SELECT * FROM `users` WHERE `name`='$username'";
    $res_e = mysqli_query($conn, $sql_e);
    $res_u = mysqli_query($conn, $sql_u);
    if(mysqli_num_rows($res_e) > 0 && mysqli_num_rows($res_u) > 0 ){
        echo "<div><h3>User already resgistered</h3></div>";	
        setcookie('name', $username);
        setcookie('email', $email);
  	}
	else if(mysqli_num_rows($res_e) > 0 && mysqli_num_rows($res_u) < 1 ){
        echo "<div><h3>Sorry... email already taken</h3></div>";	
      }
    else{
        setcookie('name', $username);
        setcookie('email', $email);
        $query = "INSERT INTO `users`(`name`, `mail`) VALUES ('$username', '$email')";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<div><h3>You are registered successfully.</h3></div>";
        }
    }
}else{
    echo "<div><h3>Please check all the fields and accept our policies</h3></div>";
}
?>
  <div class="form">
    <h1>Registration</h1>
    <form name="registration" action="" method="post">
    <input type="text" name="name" placeholder="Username" required />
    <input type="email" name="email" placeholder="Email" required />
    <div>
        <input type="radio" id="privacy" name="privacy" value="huey">
        <label for="huey">Accept privacy policy</label>
    </div>
    <input type="submit" name="submit" value="Register" />
    </form>
</div>
 <script>
 var x = document.cookie;
 console.log(x);
 </script>
</body>
</html>

