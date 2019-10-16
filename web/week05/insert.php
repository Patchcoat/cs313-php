<?php
$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=");
$query = "INSERT INTO book VALUES ('$_POST[book]','$_POST[chapter]', '$_POST[verse]','$_POST[content]')";
$result = pg_query($query);
?> 
