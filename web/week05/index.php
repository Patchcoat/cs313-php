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
echo 'test0';
try {
    echo 'text00';
    $user = 'postgres';
    $password = 'password';
    $dbUrl = getenv('DATABASE_URL');
    $dbOpts = parse_url($dbUrl);
    echo 'test000';
    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrip($dbOpts["path"],'/');
    echo 'test0000';
    $db = new PDO('pgsql:host='.$dbHost.';port='.$dbPort.';dbname='.$dbName, $dbUser, $dbPassword);
    echo 'test1';
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'test2';
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
