<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>qrs</title>
  <meta name="description" content="qrs">
  <meta name="author" content="Jordi">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
</head>
<body>
<?php
require('config.php');
//check user exist

    //cookies are enabled
    if(!isset($_COOKIE['userId'])) { 
        //user has no ID go to Register Form
        echo "no cookie";
        //rember the qr url
        if (isset($_GET['id'])) {
            setcookie('prevUrl', $_GET['id']);
            // echo "<script> window.location.href='http://localhost:8888/form.html';</script>";
           // header("Location: http://vimod.net/qrs/form.html"); 
            echo "your redirected";
            echo "<script>window.location='form.html';</script>";
            exit();
        }
      
       
    }else{
        
        //user has an Id, has been on the site 
        $userId = $_COOKIE['userId'];
        echo "welcome back id: " . $userId;
        // get params from qr url 
        if (isset($_GET['id'])) {
            $qr = $_GET['id'];
            //check visited de Qr parameter id
            $sql_id= "SELECT `$qr` FROM `codes` WHERE `id`='$userId'";
            $result= mysqli_query($conn, $sql_id);
            while ($row = $result->fetch_assoc()) {
                $qrResult= $row[$qr];
            }
            if($qrResult>0){
                //user visited the QR- show error ups screen
                echo "you allready scanned that QR";
            }else{
                //update qrs database to visited qr
                $updateQR = mysqli_query($conn, "UPDATE `codes` SET `$qr`=1 WHERE `id`='$userId'");
                //get user points
                $sql_points= "SELECT `points` FROM `users` WHERE `id`='$userId'";
                $resultPoints= mysqli_query($conn, $sql_points);
                while ($row = $resultPoints->fetch_assoc()) {
                    $pointsResult= $row['points'];
                }
                // update points of user
                if($qr<6){
                    $pointsResult+=10;
                }else{
                    $pointsResult+=15;
                }
                $updatePoints = mysqli_query($conn, "UPDATE `users` SET `points`='$pointsResult' WHERE `id`='$userId'");
                echo "points_ " .  $pointsResult;
                setcookie('points', $pointsResult);
                //show reward(check json to know points, and content)
                //display de points and user
            }

        } else {
            // Fallback behaviour goes here
        }   
    }
  

?>
<div id="menu" style="font-size:20px"></div>

</body>
<script>

    //Get data for menu, points and username from cookies
    var userPoints = getCookieValue("points");
        var userName = getCookieValue("name");
        document.getElementById("menu").innerHTML = "Hi: " + userName + "! Your points:" + userPoints;

        function getCookieValue(a) {
            var b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
            return b ? b.pop() : '';
        }

</script>
<style>
    header{
        padding: 30px;
        background-color: #080808;
    }
    .logo{
        border-radius: 50%;
    }
</style>
</html>

