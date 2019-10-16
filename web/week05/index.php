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
    $dbUrl = getenv('DATABASE_URL');
    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $db = new PDO('pgsql:host=$dbHost;port=$dbPort;dbname=$dbName', $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($db->query('SELECT book, chapter, verse, content FROM scriptures') as $row) {
        echo 'ref: ' . $row['book']. " " . $row['chapter'] . ':' . $row['verse'];
        echo 'content: '.$row['content'];
        echo '</br>';
    }

}
catch (PDOException $ex)
{
    echo 'ERROR!: ' . $ex->getMessage();
    die();
}
phpinfo();
?>
    <form action="insert.php" method="post">
        <label for="book">BOOK</label>
        <input type="text" name="book" id="book">
        <label for="chapter">CHAPTER</label>
        <input type="text" name="chapter" id="chapter">
        <label for="verse">VERSE</label>
        <input type="text" name="verse" id="verse">
        <label for="content">CONTENT</label>
        <input type="text" name="content" id="content">
        <input type="submit" value="Submit">
    </form>
</body>
</html> 
