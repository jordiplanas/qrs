<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>llumipunts</title>
  <meta name="description" content="qrs">
  <meta name="author" content="Jordi">
  <link rel="stylesheet" type="text/css" href="style.css"></link>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
  <script type="text/javascript" src="header.js"></script>
  <?php include('lang.php'); ?>
</head>
<body>
<?php
require('config.php');

//cookies are enabled
if(!isset($_COOKIE['userId'])) { 
    //user has no ID go to Register Form
    echo "no cookie";
    //rember the qr url
    if (isset($_GET['id'])) {
        setcookie('prevUrl', $_GET['id'],time() + (86400 * 90), "/");
        // header("Location: http://vimod.net/qrs/form.php"); 
        echo "<script>window.location='form.php';</script>";
        exit();
    }
}else{
    //user has an Id, has been on the site 
    $userId = $_COOKIE['userId'];
    // get params from qr url 
    if (isset($_GET['id'])) {
        $qr = $_GET['id'];
        //check visited the Qr parameter id
        $sql_id= "SELECT `$qr` FROM `codes` WHERE `id`='$userId'";
        $result= mysqli_query($conn, $sql_id);
        if(!$result){
            //if the QR doesn't exist --> send to 404 error page
            // echo "QR doesn't exist";
            echo "<script>window.location='404.php';</script>";
            exit();
        }
        while ($row = $result->fetch_assoc()) {
            $qrResult= $row[$qr];
        }
        if($qrResult>0){
            //QR code already scanned --> send to already scanned error page
            // echo "QR already scanned";
            echo "<script>window.location='invalid.php';</script>";
            exit();
        }
        //update qrs database to visited qr
        $updateQR = mysqli_query($conn, "UPDATE `codes` SET `$qr`=1 WHERE `id`='$userId'");
        //get user points
        $sql_points= "SELECT `points` FROM `users` WHERE `id`='$userId'";
        $resultPoints= mysqli_query($conn, $sql_points);
        while ($row = $resultPoints->fetch_assoc()) {
            $userPoints= $row['points'];
        }
        $json = file_get_contents('data/data.json');
        $data = json_decode($json, true); // decode the JSON into an associative array
        $qrData = $data[$qr];
        $points = $qrData["points"];

        // update points of user
        if($points){
            $userPoints += $points;
        }
        $updatePoints = mysqli_query($conn, "UPDATE `users` SET `points`='$userPoints' WHERE `id`='$userId'");
        setcookie('points', $userPoints, time() + (86400 * 90), "/");

        $embedded = $qrData["embedded"];
        // check to display embedded content or not
        $displayEmbedded = $embedded ?  'block' : 'none';     
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
            <img id="points" src="images/<?php echo $points; ?>.gif" alt="+<?php echo $points; ?> llumipunts">
        </div>
        <div class="embedded-container">
            <div class="embedded-content" style="display: <?php echo $displayEmbedded; ?>">
                    <iframe src="<?php echo $embedded; ?>" frameBorder="0"></iframe>
            </div>
        </div>
        <!-- <button class="main-btn"> RANKING </button> -->
    </section>

</body>

<style>
    .reward{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        text-align: center;
    }
    #points{
        width:100%;
    }
    .embedded-container{
        margin: 30px 0;
    }
    .embedded-content{
        width:100%;
    }
    .embedded-content > *{
        width:inherit;
    }
</style>
</html>

