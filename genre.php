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

print '<h2>'.$genreClean.' Games</h2>'; //page header


//genre description
if($genre == 'action') {
    print '<p>The action game is a video game genre that emphasizes physical challenges, including hand–eye coordination and reaction-time. The genre includes diverse subgenres such as fighting games, shooter games and platform games which are widely considered the most important action games, though multiplayer online battle arena and some real-time strategy games are also considered to be action games.</p>';
} elseif ($genre == 'sports') {
    print '<p>Sports games are often spearheaded by simulation games such as the Fifa, Madden, and NHL series. These games involve the user controlling the players on the field as one team. However, there are other sports games such as sports management games in which the user is the manager of a simulated team in a certain sport.</p>';
} elseif ($genre == 'roleplay') {
    print '<p>The role-playing game is one of the broadest categories containing thousands of major games that vary in construction and gameplay. Most games involve the user controlling a character that is part of an open-world map with other AI characters to interact with. Most are guided with main quest missions and are enriched with side quests along the way. There are also massive-multiplayer-online-role-playing-games (MMORPGs) in which players complete the stories with other players co-operatively.</p>';
}




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