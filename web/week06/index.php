<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Insert new Scripture</title>
</head>
<body class="container">
<h1>Scripture Resources</h1>
<form action="newScripture.php" method="post">
    <div>Book</div>
    <input type="text" name="Book">
    <div>Chapter</div>
    <input type="number" name="Chapter">
    <div>Verse</div>
    <input type="number" name="Verse">
    <div>Content</div>
    <input type="text" name="Content"></br>
<?php
try {
    $user = 'postgres';
    $password = 'password';

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $index = 0;
    foreach ($db->query('SELECT id, name FROM topic') as $row) {
        echo '<input type="checkbox" name="topic-'.$index.'" value="'. $row["id"].'">'.$row["name"].'</br>';
        $index++;
    }
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
?>
    <input type="checkbox" name="new-topic" value="set">
    <input type="text" name="new-topic-text"></br>
    <input type="submit" value="Submit">
</form>
</body>
</html> 
