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
            <h1>The Schulze Method</h1>
        </div>
        <div class="container">
            <div class="row_sm_12">
                <p>The Schulze Voting Method is a single winner voting method that produces a ranked list of candidates. It uses concepts found in graph theory to rank the candidates based on voters' preferencess between them. Because voters submit a ranked list including all of the candidates there isn't a need to vote for an undesirable candidate because they have a better chance to win, or because they are a lesser evil. This web page seeks to explain how it works in clear and simple terms.</p>
<?php
if(!isset($_COOKIE['visit'])) {
    $visit = time();
    setcookie('visit', $visit);
    $_COOKIE['visit'] = $visit;
}
echo "<p>You last visited ". date('Y-m-d H:i', $_COOKIE['visit'])."</p>";
setcookie("visit", time(), time() + (7 * 24 * 60 * 60));
?>
            </div>
            <div class="row_sm_4">
                <h1>Cast a Vote</h1>
            </div>
            <div class="row_sm_8">
                <canvas id="VotingCanvas" width="500" height="500">
Your browser does not support the canvas element.
                </canvas>
            </div>
        </div>
        <script src="home.js"></script>
    </body>
</html>
