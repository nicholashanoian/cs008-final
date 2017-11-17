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

print '<article class="game">';

print '<pre>';
print_r($thisGame);
print '</pre>';

$ratingColor = ratingGradient($thisGame[3]);

print '<h2>' . $thisGame[1] . '</h2>';

print '<div class="sideInfo">';

print '<fig class="rating" style="background-color:rgb(';
print $ratingColor[0] . ',' . $ratingColor[1] . ',' . $ratingColor[2];
print ')">' . $thisGame[3] . '</fig><br>';

print '<aside class="gameInfo">
    <ul>
        <li>
            <strong>Release Date</strong>: '.$thisGame[6].' 
        </li>
        <li>
            <strong>Developer</strong>: '.$thisGame[7].'
        </li>
        <li>
            <strong>Publisher</strong>: '.$thisGame[8].'
        </li>
        <li>
            <strong>Platforms</strong>: '.$thisGame[9].'
        </li>
        <li>
            <strong>Tags</strong>: '.$thisGame[10].'
        </li>
        <li>
            <strong>Rating</strong>: '.$thisGame[4].'
        </li>
    </ul>
</aside>';

print '</div>';

//cover art
print '<fig class="coverArt"><img src="images/cover-art/' .  $thisGame[5] . '"></fig>';

//game summary
print '<p class="summary"><strong>Summary</strong>: ' . $thisGame[11] . '</p>';

//game trailer
print '<iframe width="560" height="315" src="https://youtube.com/embed/'.$thisGame[16].'" frameborder="0" allowfullscreen></iframe>';

print '</article>';


include 'footer.php';


?>