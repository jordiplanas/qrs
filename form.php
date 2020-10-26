<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FORM</title>
    <meta name="description" content="FORM">
    <meta name="author" content="JORDI">
    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <?php include('lang.php'); ?>
</head>

<body>
    <div class="notification">
        <p id="message"></p>
    </div>
    <img class="hero-img" src="./assets/ui/cuadro.jpg">
    <section class="container">
        <form name="registration" id="my-form" action="" method="post">
            <input class="input" type="text" name="name" placeholder="<?php echo $copy["form:username"]; ?>" autocomplete="username" required />
            <input class="input" type="password" name="password" placeholder="<?php echo $copy["form:password"]; ?>" autocomplete="current-password" required />
            <input type="radio" name="bases" id="bases" value="black" required />
            <label for="rad1"><?php echo $copy["form:legal"]; ?></label>
            <input class="main-btn" type="submit" name="submit" value="<?php echo $copy["form:button"]; ?>" />
        </form>
    </section>
    <footer>
        <img class="logo" src="./assets/ui/logo.png">
    </footer>
    <script>
        $(document).ready(function() {
            $("#my-form").submit(function(e) {
                console.log("submt");
                e.preventDefault();
                $.ajax({
                    url: "post.php",
                    method: "post",
                    data: $("form").serialize(),
                    dataType: "text",
                    success: function(res) {
                        res = res.trim();
                        console.log(res);
                        if(res == 'success') {
                            // NEW USER SUCCESS
                            window.location.href = 'welcome.php';
                        } else if(res == 'return') {
                            // RETURNING USER 
                            $(".notification").css('display', 'block');
                            $("#message").text('welcome back!');
                            $("#my-form")[0].reset();
                            setTimeout(function() {
                                var id = getCookieValue("prevUrl");
                                window.location.href = 'index.php?id=' + id;
                            }, 2000);
                        } else {
                            // ERROR
                            $(".notification").css('display', 'block');
                            $("#message").text(res);
                            $("#my-form")[0].reset();
                        }
                    },
                    error: function () {
                        $(".notification").css('display', 'block');
                        $("#message").text("There's been an error");
                        $("#my-form")[0].reset();
                    }
                });
            });

            function getCookieValue(a) {
                var b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
                return b ? b.pop() : '';
            }
        });
    </script>
</body>

<style>
    .notification {
        position: absolute;
        display: none;
        top: 0;
        background-color: black;
        color: white;
        width: calc(100% - 40px);
        padding: 20px;
    }

    .container {
        justify-content: flex-start;
    }
    
    #message {
        margin: 0;
    }
    
    .hero-img {
        padding: 20px;
        width: calc(100vw - 40px);
        height: auto;
    }
    
    .input {
        width: calc(100% - 50px);
        padding: 20px 25px;
        border: none;
        color: white;
        background-color: black;
        border-radius: 10px;
        margin: 10px 0;
        display: block;
        font-size: 16pt;
    }
    
    .input::placeholder {
        color: white;
        font-size: 16pt;
        text-transform: uppercase;
    }
    
    .radio-btn {
        margin: 20px 0;
        color: grey;
    }
</style>

</html>