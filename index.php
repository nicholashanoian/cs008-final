<?php
include 'top.php';

$recentGames = getRecentGames($gameData);



print '<article class="home">';
print '<h2>Welcome to VGDB</h2>';

print '<p>Welcome to the Video Game Database! Here you can find information on all of your favorite video games. We’ve arranged games into three different genres: Action, Role-Play, and Sports. You can find games of each genre by clicking their links listed in the menu at the top of the page. Once you get to the page of your desired genre, you can access the games listed by simply clicking their links. Shown below are the three most recently released games. You can click on the pictures for more information. To view a list of all games, click the link below.</p>';

print '<p class="center"><a href="genre.php">View All Games</a></p>';

print '<figure class="homeCoverArtContainer">';
//print cover art links for most recent games
for($i = 0; $i < count($recentGames); $i++) {
    //get image path 
    $coverArt = getImagePathArray('images/cover-art/', $recentGames[$i][0]);
    $date = substr($recentGames[$i][4], 0, -4) . substr($recentGames[$i][4], -2);

    //print html for showing that image
    print '<figure class="homeCoverArt">';
    
    print '<figcaption>Released ';
    print $date;
    print '</figcaption>';
    
    print '<a href="game.php?gameID='.$recentGames[$i][0].'">';
    print '<img src="';
    print $coverArt[0];
    print '" alt=""></a>';
//    print '<figcaption>Released ';
//    print $date;
//    print '</figcaption></figure>';
    
    print '</figure>';

    print PHP_EOL;
    print PHP_EOL;

}
print '</figure>';

print '</article>';









include 'footer.php';