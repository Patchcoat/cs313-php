<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>You're new poll has been created!</h1>
<?php
$candidates = [];
$subject = $_POST['pollTitle'];
for ($i = 1; isset($_POST['candidate-'.$i]); $i++) {
    if ($_POST['candidate-'.$i] != ''){
        array_push($candidates, $_POST['candidate-'.$i]);
    }
}

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

    //$db = new PDO('pgsql:host='.$dbHost.';port='.$dbPort.';dbname='.$dbName, $dbUser, $dbPassword);
    $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlScriptInsert = "INSERT INTO polls (creation_date, url) VALUES (current_date, '".$subject."')";
    $stmt = $db->prepare($sqlScriptInsert);
    $stmt->execute();
    $pollID = $db->lastInsertId('polls_id_seq');

    foreach($candidates as $candidate) {
        $sqlScriptInsert = "INSERT INTO candidates (candidate, rank, poll_id) VALUES ('".$candidate."', 0, ".$pollID.")";
        $stmt = $db->prepare($sqlScriptInsert);
        $stmt->execute();
    }
    
    $link = "vote.php?poll=".$pollID;
    echo "The vote link for your poll is <a href='".$link."'>".$link."</a>";
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
?>
</body>
</html>
