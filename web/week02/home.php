<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="homeStyle.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="jumpotron text-center">
            <h1>The Schulze Method</h1>
        </div>
        <div class="container">
            <div class="row">
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
            <div class="row">
                <div class="col-md-12">
                    <h1>What does the ballot look like?</h1>
                    <p>The ballot is a list of candidates that you rank in order of your preference, in contrast to single choice voting. To demonstrate the difference, let's say that you and your friends want to decide where to eat and there are four options, Fancy Food, Fast Food, Buffet, and Pizza.</p>
                </div>
                <div class="col-md-6">
                    <h2>Single Choice Voting</h2>
                    <p>In a normal voting system you would have to vote strategically. You really want to go eat Fancy Food, but you know nobody else will be up for that. You absolutely do not want to eat Fast Food, and you know that in that Pizza has the best chance of beating it. So even though you're only OK with Pizza, you vote for it.</p>
                </div>
                <div class="col-md-6">
                    <h2>Ranked Voting</h2>
                    <p>In ranked voting you simply list the candidates in order of preference, no need to vote strategically. In our hypothetical, you would list Fancy Food first, then Pizza, then Buffet, and lastly Fast Food. Rather than a simple yes to one option, this tells us exactly what option you prefer to every other option.</p>
                </div>
                <div class="col-md-12">
                    <h1>What happens when you cast a vote?</h1>
                    <p>When you cast a vote in the Shulze Method your preferences are stored in a matrix. This matrix is just a grid of numbers that represents how strongly each candidate is prefered to every other candidate. Direction is important. If candidate A is prefered to candidate B in a vote, then the connection from A to B is made one stronger, while the connection from B to A remains the same. When it's time to tally up the votes, the "widest path" is found. This "widest path" is the path that goes through each candidate once, using the strongest connections beteween each candidate. The result of this path is a ranking of candidates, with the weakest candidate at the start of the path, and the winning candidate at the end.</p>
                </div>
            </div>
            <h1>Try it Out</h1>
            <div class="row">
                <div class="col-md-5">
                    <h1>Cast a Vote</h1>
                    <p>The lower the number, the higher the rank</p>
                    <p>You can cast as many votes as you want</p>
                    <p>Do not rank two candidates the same</p>
                    <form name="vote" id="voteForm">
                        <input name="A" type="number" class="rank"> Rank of Candidate A<br>
                        <input name="B" type="number" class="rank"> Rank of Candidate B<br>
                        <input name="C" type="number" class="rank"> Rank of Candidate C<br>
                        <input name="D" type="number" class="rank"> Rank of Candidate D<br>
                        <input name="E" type="number" class="rank"> Rank of Candidate E<br>
                        <input type="button" value="Cast Vote" id="castVote">
                        <input type="button" value="Random" id="randomVote">
                    </form>
                    <h2>Current Ranking</h2>
                    <div id="rank" class="rankList"></div>
                    <h2>Past Votes</h2>
                    <div id="pastVotes" class="pastVotesList"></div>
                </div>
                <div class="col-md-7">
                    <h1>Preference Graph</h1>
                    <canvas id="VotingCanvas" width="500" height="500">
    Your browser does not support the canvas element.
                    </canvas>
                    <p>Each red circle is a candidate and each white circle is the strength of the connection. The black circle indicates the direction of the connection.</p>
                </div>
            </div>
        </div>
        <script src="home.js"></script>
    </body>
</html>
