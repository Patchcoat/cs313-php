<!DOCTYPE html>
<html lang="en">
<head>
<title>Results</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
<?php
/*
 * candidates
 * ID, candidate, rank, poll_id
 * polls
 * ID, creation_date, url
 * votes
 * block_id, poll_id, candidate_id, rank, IP
 * */
$poll = filter_var($_GET['poll'], FILTER_SANITIZE_NUMBER_INT);
try {
    $dbURL = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbURL);
    
    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $user = 'postgres';
    $password = 'password';

    $db = new PDO('pgsql:host='.$dbHost.';port='.$dbPort.';dbname='.$dbName, $dbUser, $dbPassword);
    //$db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach($db->query('SELECT title FROM polls WHERE ID='.$poll) as $row) {
        echo '<h1 class="display-1">'.$row['title'].'</h1>';
    }
    echo '<p>Rank candidates from most desirable to least desirable</p>';
    echo '<ul class="list-group">';
    $index = 0;
    foreach ($db->query('SELECT id, candidate, rank FROM candidates WHERE poll_id='.$poll.'ORDER BY rank ASC') as $row) {
        if ($index == 0) {
            $index = $row['id'];
        }
        echo '<li class="candidate list-group-item" id="candidate-'.$row['id'].'">';
        echo '<div class="float-left">' . $row['candidate'] . "</div>";
        echo '<div class="float-right">';
        echo '<button class="btn btn-secondary" onclick="rowUp('.$row['id'].')" id="up-'.$row['id'].'">'.'↑'.'</button> ';
        echo '<button class="btn btn-secondary" onclick="rowDown('.$row['id'].')" id="down-'.$row['id'].'">'.'↓'.'</button></div>';
        echo '</li>';
    }
    echo '</ul>';
    echo '<button type="submit" onclick="castVote('.$index.', '.$poll.')" id="castVote" class="btn btn-primary">Submit</button>';
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
?>
        </div>
    </div>
</div>
<script src="vote.js"></script>
</body>
</html>
