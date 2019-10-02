<?php
$name = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$major = htmlspecialchars($_POST['major']);
$comments = htmlspecialchars($_POST['comments']);
$country = $_POST['country'];
function printlist($country){
$contMap = array('na'=>'North American','sa'=>'South American', 'eu'=>'Europe', 'as'=>'Asia', 'af'=>'Africa',
    'at'=>'Antarctica', 'au'=>'Australia');
  if(empty($country))
  {
    echo("You didn't select any buildings.");
  }
  else
  {
    $N = count($country);
    echo("You selected $N" . "<br>");
    for($i=0; $i < $N; $i++)
    {
      echo($contMap[$country[$i]] . '<br>');
    }
  }
}
//if (isset($_POST['submit'])) {
    //if(isset($_POST['radio']))
    //{
        //echo .$_POST['radio'];  //  Displaying Selected Value
//}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 03 Team Activity - Form Result</title>
        <meta name="author" content="Ching Lo | CS313:03">
        <meta name="description" content="Form Result">
​
        <!--link to external CSS Style-->
        
        <!--link to external JavaScript-->
        
        <!--jQuery library-->
        
    </head>
    
    <body>
        <main>
            <h1>Thank you, <?php echo $name; ?> . </h1>
            <p>This is the information that you provided.</p>
            <p>We will send an message to you at <a href = "mailto:<?php echo $email; ?>"> <?php echo $email; ?> : Send Now</a></p>
            <p>You have selected <?php echo $major; ?>.</p>
            <p>Your comments have been saved: "<?php echo $comments; ?>"</p>
            <p><?php  printlist($country);?></p>
        </main>
    </body>
    
</html>
