<?php
include 'top.php';

// ############################# Breadcrum Trail #############################//

if($genre=='roleplay') {
    $genreClean = 'Role-Play';
} else{
    $genreClean = ucwords($genre);
}


print('<div class="breadcrumbContainer"><nav class="breadcrumb">
    <a href="index.php">Home</a> / 
    <a href="genre.php?genre='.$genre. '">' . $genreClean .'</a>


        </nav></div>');




print '<article class="genre">';

print '<ol>';

foreach ($gameData as $gameRecord) {
    if($gameRecord[2] == $genre) {
        print '<li><a href="game.php?gameID=' . $gameRecord[0] . '">';
        print $gameRecord[1];
        print '</a></li>';
    }
}

print '</ol>';

print '</article>';


include 'footer.php';



?>