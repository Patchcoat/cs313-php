<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="jumpotron text-center">
            <h1>Home</h1>
        </div>
        <div class="container">
            <div class="row_sm_12">
<?php
echo "You last visited ". date('Y-m-d H:i', $_COOKIE["visit"]);
setcookie("visit", time(), time() + (60 * 60));
?>
            </div>
        </div>
        <script src="home.js"></script>
    </body>
</html>
