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
<h1>Scripture Resources</h1>
<?php
try {
    $user = 'postgres';
    $password = 'password';

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', $user, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($db->query('SELECT id, book, chapter, verse, content FROM scriptures') as $row) {
        echo '<strong><a href="details.php?id='.$row['id'].'">' . $row['book']. " " . $row['chapter'] . ':' . $row['verse'].'</a></strong>';
        echo '</br>';
    }
}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
?>
<form action="search.php" method="post">
    <label for="search">Search</label>
    <input type="text" name="search" id="search">
    <br>
    <input type="submit" value="Submit">
</form>
</body>
</html> 
