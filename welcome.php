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
        <img class="logo" src="./assets/ui/logo.png">
    </footer>
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