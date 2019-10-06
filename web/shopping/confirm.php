<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 03 Prove</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Gondolas For Sale</a>
                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart
                        <span class="badge badge-secondary badge-pill" id="cart"></span></a>
                    </li>
                </ul>
            </div>
        </nav>
        </br></br></br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h1 class="text-center">Your order has been confirmed!</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
<?php
$filenames = [
"America Gondola.jpg",
"Apocalypse Gondola.jpg",
"Bath Gondola.png",
"Bedroom Gondola.png",
"Campfire Gondola.png",
"Desert Gondola.png",
"Flower Gondola.png",
"Library Gondola.jpg",
"Night Walk Gondola.jpg",
"Samurai Gondola.png",
"Seafoam Gondola.jpg",
"Ski Lift Gondola.jpg",
"Snow Hike Gondola.gif",
"System Shock Gondola.png",
"Two Gondola.gif",
"Wasteland Gondola.png",
"Window Gondola.png",
"Woodcut Gondola.png"];

$prices = [19.99, 30.00, 5.49, 386.72, 2.99, 5.99, 7.00, 10.00, 2.99, 3.39, 1000.00, 49.99, 38.99, 9.99, 5.99, 19.99, 7.50, 39.00];

$shoppingCart = json_decode($_COOKIE['cart'], TRUE);

echo "<ul class=\"list-group list-group-flush\">";
$total = 0;
for ($i = 0; $i < count($shoppingCart); $i++) {
    $cartItem = $shoppingCart[$i];
    $name = $filenames[$cartItem];
    $total += $prices[$cartItem];
    echo "<li class=\"list-group-item d-flex justify-content-between align-items-center\">";
    echo substr($name, 0, strpos($name, "."));
    echo "<span class=\"badge badge-primary badge-pill\">$".number_format($prices[$cartItem], 2)."</span>";
    echo "</li>";
}
echo "<li class=\"list-group-item d-flex justify-content-between align-items-center list-group-item-primary\">Total";
echo "<span class=\"badge badge-primary badge-pill\">$".number_format($total, 2)."</span>";
echo "</ul>";
?>
                </div>
                <div class="col-md-6">
                    <h3>Mailing Address</h3>
<?php
$name = htmlspecialchars(filter_var($_POST['name']));
$address = htmlspecialchars(filter_var($_POST['address']));
$city = htmlspecialchars(filter_var($_POST['city']));
$state = htmlspecialchars(filter_var($_POST['state']));
$zip = htmlspecialchars(filter_var($_POST['zip']));

echo $name."<br>";
echo $address."<br>";
echo $city.", ".$state." ".$zip."<br>";

setcookie('cart', json_encode([]));
?>
                </div>
            </div>
        </div>
    </body>
</html>
