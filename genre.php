<?php
include 'top.php';

if(isset($_GET["genre"])){
        $genre = htmlentities($_GET['genre'], ENT_QUOTES, "UTF-8");    
}

print '<ol>';

$lastGenre = '';
foreach ($gameData as $gameRecord) {
    if($gameRecord[2] == $genre) {
        print '<li><a href="game.php?gameID=' . $gameRecord[0] . '">';
        print $gameRecord[1];
        print '</a></li>';
    }
}

print '</ol>';



?>