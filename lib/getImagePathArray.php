<?php

function getImagePathArray($path, $folder) {
    //setup path to folder containing images
    $path .= $folder;
    $path .= '/';

    //create new iterator of that folder
    $imageIterator = new FilesystemIterator($path);

    //create array containing file names of that folder
    $imageEntries = array();
    foreach ($imageIterator as $fileInfo) {
        $imageEntries[] = $fileInfo -> getFilename();
    }
    
    //create output array of complete image paths
    $pathArray = array();
    foreach($imageEntries as $entry) {
        $pathArray[] = $path . $entry;
    }
    
    return $pathArray;
    
}

?>