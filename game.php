<?php
include 'top.php';


if (isset($_GET["gameID"])){
    $gameID = htmlentities($_GET['gameID'], ENT_QUOTES, "UTF-8");;    
}

foreach ($gameData as $gameRecord) {
    if ($gameRecord[0] == $gameID){
        $thisGame = $gameRecord;
    }
}

print '<pre>';
print_r($thisGame);
print '</pre>';

$ratingColor = ratingGradient($thisGame[3]);

print '<h2>' . $thisGame[1] . '</h2>';

print '<fig class="rating" style="background-color:rgb(';
print $ratingColor[0] . ',' . $ratingColor[1] . ',' . $ratingColor[2];
print ')">' . $thisGame[3] . '</fig><br>';


print '<fig class="coverArt"><img src="images/cover-art/' .  $thisGame[5] . '"></fig>';
