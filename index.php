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
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
  <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
  <script type="text/javascript" src="header.js"></script>
  <script type="text/javascript" src="footer.js"></script>
  <?php include('lang.php'); ?>
</head>
<body>
<?php
require('config.php');
$useragent=$_SERVER['HTTP_USER_AGENT'];
$isMobile = false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
    $isMobile=true;
}

if (!isset($_GET['id']) && !$isMobile) {
    // someone has entered directly to www.llumipunts.cat in desktop
    echo "<script>window.location='splash.html';</script>";
    exit();
}else if(!isset($_GET['id']) && $isMobile){
    echo "<script>window.location='index.php?id=110';</script>";
}
//cookies are enabled
else if(!isset($_COOKIE['userId'])) { 
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
    $json = file_get_contents('data/data.json');
    $data = json_decode($json, true); // decode the JSON into an associative array
    // get params from qr url 
    if (isset($_GET['id'])) {
        $qr = $_GET['id'];
        //check visited the Qr parameter id
        if(!$data[$qr]){
            //if the QR doesn't exist --> send to 404 error page
            // echo "QR doesn't exist";
            echo "<script>window.location='404.php';</script>";
            exit();
        }
        $sql_id= "SELECT `$qr` FROM `codes` WHERE `id`='$userId'";
        $result= mysqli_query($conn, $sql_id);
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
        $qrData = $data[$qr];
        $points = $qrData["points"];

        // update points of user
        if($points){
            $userPoints += $points;
        }
        $updatePoints = mysqli_query($conn, "UPDATE `users` SET `points`='$userPoints' WHERE `id`='$userId'");
        setcookie('points', $userPoints, time() + (86400 * 90), "/");

        $embedded = $qrData["embedded"] ;
        // check to display embedded content or not
        $displayEmbedded = $embedded ?  'block' : 'none'; 
        
        $ar = $qrData["ar"] ;
        // check to display embedded content or not
        $displayAr = $ar ?  'block' : 'none';     
    }  
}
?>
    <header>
        <!-- <img class="logo" src="https://www.fillmurray.com/g/100/100"> -->
        <div class="user-info">
            <span id="user-name"></span>
            <span id="user-points"></span>
        </div>
    </header>

    <section class="container">
        <div class="reward">
            <img id="points" src="assets/images/<?php echo $points; ?>.gif" alt="+<?php echo $points; ?> llumipunts">
        </div>
        <div class="embedded-container">
            <div class="embedded-content" style="display: <?php echo $displayEmbedded; ?>">
                    <img src="<?php echo $embedded; ?>" alt="magic gif">
            </div>
            <model-viewer autoplay class="embedded-content" style="display: <?php echo $displayAr; ?>" src="./assets/models/<?php echo $ar; ?>/scene.gltf" ar ar-modes="webxr scene-viewer quick-look" ar-scale="auto" camera-controls alt="Llumipunts" ios-src="./assets/models/<?php echo $ar; ?>.usdz"></model-viewer>
        </div>
        <!-- <button class="btn" onclick="location.href='/ranking.php'" type="button"> RANQUING </button> -->
    </section>
    <footer>
        <div class="links">
            <a onclick="showInfo()"> <?php echo $copy["footer:info"]; ?></a>
            <a href="/ranking.php"> <?php echo $copy["footer:ranking"]; ?></a>
            <a onclick="showLegal()"> <?php echo $copy["footer:legal"]; ?> </a>
        </div>
        <img class="logo" src="./assets/ui/logo.png">
    </footer>
    <section id="info-overlay" class="overlay" onclick="closeInfo()">
        <div class="overlay-content">
            <!-- <a onclick="closeInfo()" class="close"></a> -->
            <img style="max-width: 100%; height: auto;" src="assets/images/info.png" alt="info">
        </div>
    </section>

    <section id="legal-overlay" class="overlay" onclick="closeLegal()">
            <div class="overlay-content">
                <!-- <a onclick="closeLegal()" class="close"></a> -->
                <img style="max-width: 100%; height: auto;" src="assets/images/b.png" alt="info">
            </div>
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
    model-viewer{
        height: 50vh;
    }
    .embedded-content > *{
        width:inherit;
    }
</style>
</html>

