<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 03 Team Activity</title>
        <meta name="author" content="Ching Lo | CS313:03">
        <meta name="description" content="Week 3 Team Activity">
​
        <!--link to external CSS Style-->
        
        <!--link to external JavaScript-->
        
        <!--jQuery library-->
        
    </head>
    
    <body>
        <main>
            <h1>Test Form</h1>
            <form method="post" action="results.php">
                Name: <input type="text" name="username"><br><br>
                Email: <input type="text" name="email"><br><br>
                Major: <br><br>
                <?php
        $majors = array('Computer Science', 'Web Design and Development','Computer Information Technology'
        ,'Computer Engineering');
        foreach ($majors as $major){
            echo "<input type='radio' name='major' value='$major'>$major<br>";
        }
?><br><br>
                Comments: <br><textarea type="text" name="comments" rows="10" cols="30"></textarea><br><br>
                <input type="checkbox" name="country[]" value="na">North America<br>
                <input type="checkbox" name="country[]" value="sa">South America<br>
                <input type="checkbox" name="country[]" value="eu">Europe<br>
                <input type="checkbox" name="country[]" value="au">Australia<br>
                <input type="checkbox" name="country[]" value="af">Africa<br>
                <input type="checkbox" name="country[]" value="as">Asia<br>
                <input type="checkbox" name="country[]" value="at">Antarctica<br>
                <input type="submit" value="Submit">
            </form>
        </main>
    </body>
    
</html>
