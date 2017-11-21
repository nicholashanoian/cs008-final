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

// ############################ Begin Game Article ########################## //

print '<article class="game">';

print PHP_EOL;
print PHP_EOL;

//to show row of data for this game for debugging

//print '<pre>';
//print_r($thisGame);
//print '</pre>';
//
//
//print PHP_EOL;
//print PHP_EOL;


$ratingColor = ratingGradient($thisGame[3]);

print '<h2>' . $thisGame[1] . '</h2>';

print PHP_EOL;
print PHP_EOL;

// ############################ Side Info Box ############################### //

print '<div class="sideInfo">';

print PHP_EOL;
print PHP_EOL;


// ########################### Rating Box ################################### //
print '<fig class="rating" style="background-color:rgb(';
print $ratingColor[0] . ',' . $ratingColor[1] . ',' . $ratingColor[2];
print ')">' . $thisGame[3] . '</fig><br>';

print PHP_EOL;
print PHP_EOL;

// ########################### Game Info #################################### //
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

print PHP_EOL;
print PHP_EOL;


// ############################ Cover Art ################################### //

//setup path to folder containing cover art
$coverArtPath = 'images/cover-art/';
$coverArtPath .= $thisGame[0];
$coverArtPath .= '/';

//create new iterator of that folder
$gameCoverArt = new FilesystemIterator($coverArtPath);

//create array containing file names of that folder
$coverArtEntries = array();
foreach ($gameCoverArt as $fileInfo) {
    $coverArtEntries[] = $fileInfo -> getFilename();
}


//print html for showing that image
print '<fig class="coverArt"><img src="' . $coverArtPath;
print $coverArtEntries[0];
print '"></fig>';

print PHP_EOL;
print PHP_EOL;

// ############################ Summary ##################################### //

print '<p class="summary"><strong>Summary</strong>: ' . $thisGame[11] . '</p>';

print PHP_EOL;
print PHP_EOL;


// ############################ Screenshots ################################# //


//setup path to folder containing screenshots
$screenshotPath = 'images/screenshots/';
$screenshotPath .= $thisGame[0];
$screenshotPath .= '/';

//create new iterator of that folder
$gameScreenshots = new FilesystemIterator($screenshotPath);

//create array containing file names of that folder
$screenshotEntries = array();
foreach ($gameScreenshots as $fileInfo) {
    $screenshotEntries[] = $fileInfo -> getFilename();
}



//create div to hold all images in the folder
print '<div id="screenshotContainer">';

//print images with sources from the array
foreach ($screenshotEntries as $src) {
    print '<img class="screenshotSlides" src="' . $screenshotPath;
    print $src;
    print '" alt="">';
    print PHP_EOL;
}

//create div for buttons of slider
print '<div class="center display-bottom-middle" style="width:100%">';

//create left and right buttons for slider
print '<div class="left button" onclick="moveImg(-1)">&#10094;</div>';
print '<div class="right button" onclick="moveImg(1)">&#10095;</div>';

//for each image in slider add a bottom button
for ($i; $i < count($screenshotEntries); $i++) {
    print '<div class="smallButton demo" onclick="setImg('; 
    if ($i == 0) {
        print '0'; //php didn't want to print a zero (printed nothing) so had to force it
    } else {
        print $i; //normally print game id
    }
    print ')"></div>';
             
}

print '</div>';

print '</div>';



print PHP_EOL;
print PHP_EOL;

// ############################ Game Trailer ################################ //

print '<div class="video-container">';

print '<iframe width="640" height="352" src="https://youtube.com/embed/'.$thisGame[16].'" frameborder="0" allowfullscreen></iframe>';

print '</div>';

print PHP_EOL;
print PHP_EOL;

print '</article>';

// ######################### End Game Article ############################ //

print PHP_EOL;
print PHP_EOL;

include 'footer.php';


?>