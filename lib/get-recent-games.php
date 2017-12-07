<?php

function getRecentGames($data) {

    $firstRecentIndex = 0;
    $secondRecentIndex = 0;
    $thirdRecentIndex = 0;

    //get index of most recent game
    for($i = 0; $i < count($data); $i++) {
        if(strtotime($data[$i][4]) > strtotime($data[$firstRecentIndex][4])) {
            $firstRecentIndex = $i;
        }
    }

    //get index of second most recent game 
    for($i = 0; $i < count($data); $i++) {
        if($i != $firstRecentIndex) {
            if(strtotime($data[$i][4]) > strtotime($data[$secondRecentIndex][4])) {
                $secondRecentIndex = $i;
            }
        }
    }

    //get index of third most recent game 
    for($i = 0; $i < count($data); $i++) {
        if($i != $firstRecentIndex AND $i != $secondRecentIndex) {
            if(strtotime($data[$i][4]) > strtotime($data[$thirdRecentIndex][4])) {
                $thirdRecentIndex = $i;
            }
        }
    }

    //array of three most recent games
    $recentGames = [$data[$firstRecentIndex], $data[$secondRecentIndex], $data[$thirdRecentIndex]];
    
    return $recentGames; //return array
}

?>