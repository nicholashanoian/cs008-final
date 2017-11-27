<?php
include 'top.php';



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