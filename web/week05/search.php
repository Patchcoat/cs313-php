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
<?php
try {
    $user = 'postgres';
    $password = 'password';

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($db->query('SELECT book, chapter, verse, content FROM scriptures WHERE book=\''.$_POST['search']."'") as $row) {
        echo '<strong>' . $row['book']. " " . $row['chapter'] . ':' . $row['verse'].'</strong> - "'.$row['content'].'"';
        echo '</br>';
    }

}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
?>
</body>
