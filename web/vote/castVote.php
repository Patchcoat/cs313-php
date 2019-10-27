<?php
/*
 * candidates
 * ID, candidate, rank, poll_id
 * polls
 * ID, creation_date, url
 * votes
 * block_id, poll_id, candidate_id, rank, IP
 * */
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

    $poll = $_POST['poll'];
    $blockID = 0;
    foreach ($db->query("SELECT max(block_id) FROM votes") as $row) {
        if (isset($row["max"])) {
            $blockID = $row["max"];
        }
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $rows = $db->query("SELECT ip FROM votes WHERE ip='".$ip."'");
    if (sizeof($rows) > 0) {
        error_log($ip." is trying to submit more than one vote");
        for ($i = 0; isset($_POST[$i]); $i++) {
            $candidate = $_POST[$i];
            $sqlScriptInsert = "UPDATE votes SET rank=".$i." WHERE candidate_id=".$candidate;
            $stmt = $db->prepare($sqlScriptInsert);
            $stmt->execute();
        }
    } else {
        for ($i = 0; isset($_POST[$i]); $i++) {
            $candidate = $_POST[$i];
            $sqlScriptInsert = "INSERT INTO votes (block_id, poll_id, candidate_id, rank, ip) ".
                "VALUES (".$blockID.", ".$poll.", ".$candidate.", ".$i.", '".$ip."')";
            $stmt = $db->prepare($sqlScriptInsert);
            $stmt->execute();
        }
    }
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    error_log('ERROR!: ' . $ex->getMessage());
    die();
}
?>
