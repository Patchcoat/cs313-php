<!DOCTYPE html>
<html lang="en">
<head>
<title>Results</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach($db->query('SELECT url FROM polls WHERE ID='.$poll) as $row) {
        echo '<h1 class="display-1">'.$row['url'].' voting</h1>';
    }
    echo '<p>Rank candidates from most desirable to least desirable</p>';
    echo '<div>';
    $index = 1;
    foreach ($db->query('SELECT id, candidate, rank FROM candidates WHERE poll_id='.$poll.'ORDER BY rank ASC') as $row) {
        echo '<div><div id="candidate-'.$row['id'].'">' . $row['candidate'] . " ";
        echo '<button class="btn btn-secondary" id="up-'.$row['id'].'">'.'↑'.'</button> ';
        echo '<button class="btn btn-secondary" id="down-'.$row['id'].'">'.'↓'.'</button></div></br>';
        echo '</div>';
        $index++;
    }
    echo '<button type="submit" class="btn btn-primary">Submit</button>';
    echo '</div>';
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
</body>
</html>
