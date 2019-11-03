<?php
/*
 * candidates
 * ID, candidate, rank, poll_id
 * polls
 * ID, creation_date, url
 * votes
 * block_id, poll_id, candidate_id, rank, IP
 * */

function FormRank($count, $connections) {
    $rankRow = array_fill(0, $count, 0);
    $ranks = array_fill(0, $count, $rankRow);
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count; $j++) {
            if ($i != $j) {
                if ($connections[$i][$j] > $connections[$j][$i]) {
                    $ranks[$i][$j] = $connections[$i][$j];
                } else {
                    $ranks[$i][$j] = 0;
                }
            }
        }
    }
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count; $j++) {
            if ($i != $j) {
                for ($k = 0; $k < $count; $k++) {
                    if ($i != $k && $j != $k) {
                        $ranks[$j][$k] = max($ranks[$j][$k], min($ranks[$j][$i], $ranks[$i][$k]));
                    }
                }
            }
        }
    }

    $rankList = array();
    for ($i = 0; $i < $count; $i++) {
        array_push($rankList,$i);
    }

    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count; $j++) {
            if ($i != $j) {
                $iIndex = array_search($i, $rankList);
                $jIndex = array_search($j, $rankList);
                if ($ranks[$i][$j] < $ranks[$j][$i]) {
                    if ($iIndex < $jIndex) {
                        $temp = array_splice($rankList,$iIndex, 1);
                        array_splice($rankList, $jIndex, 0, $temp);
                    }
                } else {
                    if ($jIndex < $iIndex) {
                        $temp = array_splice($rankList,$iIndex, 1);
                        array_splice($rankList, $jIndex, 0, $temp);
                    }
                }
            }
        }
    }
    return $rankList;
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

    $db = new PDO('pgsql:host='.$dbHost.';port='.$dbPort.';dbname='.$dbName, $dbUser, $dbPassword);
    //$db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $poll = $_POST['poll'];
    $blockID = 0;
    foreach ($db->query("SELECT max(block_id) FROM votes") as $row) {
        if (isset($row["max"])) {
            $blockID = $row["max"]+1;
        }
    }
    $minCandidate = 0;
    foreach ($db->query("SELECT min(id) FROM candidates WHERE poll_id=".$poll) as $row) {
        if (isset($row["min"])) {
            $minCandidate = $row["min"];
        }
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $rows = $db->query("SELECT ip FROM votes WHERE ip='".$ip."' AND poll_id=".$poll);
    $count = 0;
    foreach($rows as $row) {
        $count++;
    }
    //$count = 0;
    if ($count > 0) {
        error_log($ip." is trying to submit more than one vote");
        $count = 0;
        for ($i = 0; isset($_POST[$i]); $i++) {
            $count++;
            $candidate = $_POST[$i];
            $sqlScriptInsert = "UPDATE votes SET rank=".$i." WHERE candidate_id=".$candidate;
            $stmt = $db->prepare($sqlScriptInsert);
            $stmt->execute();//TODO uncomment this so that a vote can be updated
        } 
    } else {
        error_log("Inserting new vote.");
        $count = 0;
        for ($i = 0; isset($_POST[$i]); $i++) {
            $count++;
            $candidate = $_POST[$i];
            $sqlScriptInsert = "INSERT INTO votes (block_id, poll_id, candidate_id, rank, ip) ".
                "VALUES (".$blockID.", ".$poll.", ".$candidate.", ".$i.", '".$ip."')";
            $stmt = $db->prepare($sqlScriptInsert);
            $stmt->execute();
        }
    }
    // Calculate new rank
    $connectionRow = array_fill(0, $count, 0);
    $connections = array_fill(0, $count, $connectionRow);
    $votes = array();
    foreach($db->query("SELECT block_id, candidate_id, rank FROM votes WHERE poll_id=".$poll." ORDER BY block_id, rank") as $row) {
        $votes[$row['block_id']][$row['rank']] = $row['candidate_id'];
    }
    foreach($votes as $vote) {
        $exists = array();
        for($i = 0; $i < sizeof($vote); $i++) {
            $conAdr = $vote[$i]-$minCandidate;
            array_push($exists, $conAdr);
            for ($j = 0; $j < $count; $j++) {
                if (in_array($j, $exists)) {
                    continue;
                }
                $connections[$conAdr][$j]++;
            }
        }
    }
    $rankList = FormRank($count, $connections);
    for($i = 0; $i < $count; $i++) {
        $candidateID = $minCandidate+$rankList[$i];
        $sqlScriptUpdate = "UPDATE candidates SET rank=".$i." WHERE id=".$candidateID;
        $stmt = $db->prepare($sqlScriptUpdate);
        $stmt->execute();
    }
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    error_log('ERROR!: ' . $ex->getMessage());
    die();
}
?>
