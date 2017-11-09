<?php

function ratingGradient($rating) {
	$b = 0;
	if($rating < 70) {
		$r = 255;
	}
	else {
		$r = 255 - 7*($rating-63);
	}
    
    
	if($rating < 20) {
		$g = 0;
	}
	else {
		$g = 7*($rating-20);
	}
    
    return [$r, $g, $b];
    
}
