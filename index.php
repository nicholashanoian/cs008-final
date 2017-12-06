<?php
include 'top.php';


$firstRecentIndex = 0;
$secondRecentIndex = 0;
$thirdRecentIndex = 0;


//get index of most recent game
for($i = 0; $i < count($gameData); $i++) {
    if(strtotime($gameData[$i][4]) > strtotime($gameData[$firstRecentIndex][4])) {
        $firstRecentIndex = $i;
    }
}

//get index of second most recent game 
for($i = 0; $i < count($gameData); $i++) {
    if($i != $firstRecentIndex) {
        if(strtotime($gameData[$i][4]) > strtotime($gameData[$secondRecentIndex][4])) {
            $secondRecentIndex = $i;
        }
    }
}

//get index of third most recent game 
for($i = 0; $i < count($gameData); $i++) {
    if($i != $firstRecentIndex AND $i != $secondRecentIndex) {
        if(strtotime($gameData[$i][4]) > strtotime($gameData[$thirdRecentIndex][4])) {
            $thirdRecentIndex = $i;
        }
    }
}

//array of three most recent games
$recentGames = [$gameData[$firstRecentIndex], $gameData[$secondRecentIndex], $gameData[$thirdRecentIndex]];




print '<article class="home">';
print '<h2>Welcome to VGDB</h2>';

print '<p>Welcome to the Video Game Database! Here you can find information on all of your favorite video games. We’ve arranged games into three different genres: Role-Play, Action, and Sports. You can find game of each genre by clicking their links listed here, or by using the menu at the top of the page. Once you get to the page of your desired genre, you can access the games listed by simply clicking their links. Shown below are the three most recently released games. You can click on the pictures for more information.</p>';

print '<div class="homeCoverArtContainer">';
//print cover art links for most recent games
for($i = 0; $i < count($recentGames); $i++) {
    //get image path 
    $coverArt = getImagePathArray('images/cover-art/', $recentGames[$i][0]);

    //print html for showing that image
    print '<figure class="homeCoverArt"><a href="game.php?gameID='.$recentGames[$i][0].'">';
    print '<img src="';
    print $coverArt[0];
    print '" alt=""></a></figure>';

    print PHP_EOL;
    print PHP_EOL;

}
print '</div>';

print '</article>';









include 'footer.php';