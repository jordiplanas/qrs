<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>qrs</title>
  <meta name="description" content="qrs">
  <meta name="author" content="Jordi">
  <link rel="stylesheet" type="text/css" href="style.css"></link>
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
            echo "you're redirected";
            echo "<script>window.location='form.html';</script>";
            exit();
        }
    }else{
        //user has an Id, has been on the site 
        $userId = $_COOKIE['userId'];
        // echo "welcome back id: " . $userId;
        // get params from qr url 
        if (isset($_GET['id'])) {
            $qr = $_GET['id'];
            //check visited de Qr parameter id
            $sql_id= "SELECT `$qr` FROM `codes` WHERE `id`='$userId'";
            $result= mysqli_query($conn, $sql_id);
            if(!$result){
                //if the QR doesn't exist --> send to 404 error page
                // echo "QR doesn't exist";
                echo "<script>window.location='404.html';</script>";
            }
            while ($row = $result->fetch_assoc()) {
                $qrResult= $row[$qr];
            }
            if($qrResult>0){
                //QR code already scanned --> send to already scanned error page
                echo "already scanned";
                // echo "<script>window.location='invalid.html';</script>";
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
    <header>
        <img class="logo" src="https://www.fillmurray.com/g/100/100">
        <div class="user-info">
            <span id="user-name"></span>
            <span id="user-points"></span>
        </div>
    </header>

    <section class="container">
        <div class="reward">
            <span id="points">10</span>
            <span>pts</span>
        </div>
        <div class="embedded-content">
            <img class="image" src="https://www.fillmurray.com/g/400/300">
        </div>
        <button class="main-btn"> RANKING </button>
    </section>

</body>
<script>

    //Get data for menu, points and username from cookies
    var userPoints = getCookieValue("points");
    var userName = getCookieValue("name");
    document.getElementById("user-name").innerHTML = userName;
    document.getElementById("user-points").innerHTML = userPoints + " pts";

    function getCookieValue(a) {
        var b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
        return b ? b.pop() : '';
    }

</script>
<style>
    .reward{
        background-color: grey;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        color: white;
        text-align: center;
    }
    #points{
        font-size: 50pt;
        font-weight: bold;
    }
    .embedded-content{
        width:100%;
        margin: 30px 0;
    }
    .embedded-content > *{
        width:inherit;
    }
</style>
</html>

