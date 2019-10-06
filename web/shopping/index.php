<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 03 Prove</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Gondolas For Sale</a>
                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
                </ul>
            </div>
        </nav>
        </br></br></br>
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

$description = [
    "Two patriotic gondola, one squatting the other dancing. Shades, flag, and rifle included",
    "Gondola sitting on a dock with it's feet dipped in an iradiated pool. Society has collapsed, but the gondola carries on.",
    "A gondola sitting in green water with a rubber duck.",
    "A tastefully melancholic gondola. For the discerning collector.",
    "A gondola sitting next to a campfire.",
    "A very warm gondola standing infront of a gondola cactus and whiping it's brow.",
    "Happy to have found a flower, the gondola is content with it's lack of arms to be able to pick it",
    "A gondola sitting amongst a collection of human knowledge and fiction",
    "Big strides are being made by this gondola.",
    "Three gondola in Samurai outfits in japan.",
    "The best gondola in our collection",
    "The environment takes center stage as the gondola ride up and down the snowy hill.",
    "A gondola making it's way through a snowy field.",
    "A gondola with cybernetic impats making it's way through a derelict space station.",
    "Two gondola for the price of one. They don't mind the rain.",
    "A resistant gondola making the best of the Russian wasteland.",
    "This gondola is always there, even when you don't want it to be.",
    "A gondola in the style of a Mideval woodcut."];
echo "<div class=\"container\">";
echo "<div class=\"row\">";
for ($i = 0; $i < count($filenames); $i++) {
    echo "<div class=\"col-lg-4 col-md-6 mb-4\">";
    echo "<div class=\"card h-100\">";
    echo "<a href=\"#\"><img class=\"card-img-top\" src=\"gondola/".$filenames[$i]."\" alt></a>";
    echo "<div class=\"card-body\">";
    echo "<h4 class=\"card-title\">".substr($filenames[$i], 0, strpos($filenames[$i], "."))."</h4>";
    echo "<p class=\"card-text\">".$description[$i]."</p>";
    echo "</div>";
    echo "<div class=\"card-footer\">";
    echo "<small class=\"text-muted\">$".$prices[$i]."</small>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";
echo "</div>";
?>
    </body>
</html>
