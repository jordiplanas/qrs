<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
    <meta name="description" content="404">
    <meta name="author" content="JORDI">
    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="header.js"></script>
    <script type="text/javascript" src="footer.js"></script>
    <?php include('lang.php'); ?>
</head>

<body>
    <header>
        <!-- <img class="logo" src="https://www.fillmurray.com/g/100/100"> -->
        <div class="user-info">
            <span id="user-name"></span>
            <span id="user-points"></span>
        </div>
    </header>
    <section class="container">
        <div class="message">
            <div>
                <h1><?php echo $copy["welcome:title"]; ?></h1>
                <p><?php echo $copy["welcome:p"]; ?></p>
            </div>
        </div>
        <button class="btn" onclick="btnClick()"><?php echo $copy["welcome:button"]; ?></button>
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
                <?php echo $copy["legal:copy"]; ?>
            </div>
    </section>
</body>
<script>
    function btnClick(){
        var id = getCookieValue("prevUrl");
        window.location.href = 'index.php?id=' + id;
    }
    function getCookieValue(a) {
        var b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
        return b ? b.pop() : '';
    }
</script>
</html>