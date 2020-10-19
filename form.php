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
    <img class="hero-img" src="https://www.fillmurray.com/g/500/500">
    <section class="container">
        <form name="registration" id="my-form" action="" method="post">
            <input class="input" type="text" name="name" placeholder="<?php echo $copy["form:username"]; ?>" autocomplete="username" required />
            <input class="input" type="password" name="password" placeholder="<?php echo $copy["form:password"]; ?>" autocomplete="current-password" required />
            <input class="main-btn" type="submit" name="submit" value="<?php echo $copy["form:button"]; ?>" />
        </form>
    </section>
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
    
    #message {
        margin: 0;
    }
    
    .hero-img {
        width: 100vw;
        object-fit: cover;
        object-position: center;
    }
    
    .input {
        width: calc(100% - 50px);
        padding: 20px 25px;
        border: none;
        background-color: lightgrey;
        border-radius: 10px;
        margin: 10px 0;
        display: block;
    }
    
    .input::placeholder {
        color: black;
        font-size: 16pt;
    }
    
    .radio-btn {
        margin: 20px 0;
        color: grey;
    }
</style>

</html>