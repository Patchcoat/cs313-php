<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Scripture Resources</title>
</head>
<body class="container">
<h1></h1>
<?php
try {
    $user = 'postgres';
    $password = 'password';

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $book = $_POST["Book"];
    $chapter = $_POST["Chapter"];
    $verse = $_POST["Verse"];
    $content = $_POST["Content"];
    $topics = [];
    $index = 0;
    foreach ($db->query('SELECT id, name FROM topic') as $row) {
        $index++;
    }
    for ($i = 0; $i < $index; $i++) {
        if (isset($_POST["topic-".$i])) {
            array_push($topics, $_POST["topic-".$i]);
        }
    }
    if (!isset($_POST["new_topic"])) {
        $name = $_POST["new-topic-text"];
        $sqlScriptInsert = "INSERT INTO topic (name) VALUES ('".$name."')";
        $stmt = $db->prepare($sqlScriptInsert);
        $stmt->execute();
        array_push($topics, $db->lastInsertId('topic_id_seq'));
    }

    if (isset($_POST["Book"]){
        $sqlScriptInsert = "INSERT INTO scriptures (book, chapter, verse, content) VALUES (?,?,?,?)";
        $stmt= $db->prepare($sqlScriptInsert);
        $stmt->execute([$book,$chapter,$verse,$content]);
        $scripture = $db->lastInsertId('scriptures_id_seq');

        $sqlScriptTopicInsert = "INSERT INTO scripture_topic (topic, scripture) VALUES(?,?)";
        $stmt= $db->prepare($sqlScriptTopicInsert);
        foreach ($topics as $topic) {
            $stmt->execute([$topic,$scripture]);
        }
    }

    foreach ($db->query('SELECT id, book, chapter, verse, content FROM scriptures') as $row1) {
        echo '<strong>'.$row1["book"].' '.$row1["chapter"].':'.$row1["verse"].'</strong> '.$row1["content"].'</br>';
        $scriptureTopicQuery = 'SELECT topic, scripture FROM scripture_topic WHERE scripture='.$row1["id"];
        foreach ($db->query($scriptureTopicQuery) as $row2) {
            $topicQuery = 'SELECT id, name FROM topic WHERE id='.$row2["topic"];
            foreach ($db->query($topicQuery) as $row3) {
                echo '<strong>'. $row3["name"].'</strong></br>';
            }
        }
    }
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
?>
</body>
</html> 
