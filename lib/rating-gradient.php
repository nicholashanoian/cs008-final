<?php

function ratingGradient($rating) {
    //set red content
    if($rating < 70) { //rating < 70, red or yellow
        $r = 255;
    }else { //rating > 70, remove red to make green
        $r = 255 - 7 * ($rating - 63);
    }

    //set green content
    if($rating < 20) { //rating < 20, all red
        $g = 0;
    }else { //rating > 20, add green to make yellow
        $g = 7 * ($rating - 20);
    }

    //set blue content
    $b = 0;
    
    //return array with rgb values
    return [$r, $g, $b];
}
