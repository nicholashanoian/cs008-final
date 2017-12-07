<!-- ####################    Start of  Nav   ############################ -->



<nav id="topnav">
    <ol>
        <?php
               
        print '<li class="';
        if($path_parts['filename'] == 'index') {
            print 'activePage';}
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'action') {
            print 'activePage';}    
        print '">';
        print '<a href="genre.php?genre=action">Action</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'roleplay') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=roleplay">Role-Play</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'sports') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=sports">Sports</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'form') {
            print 'activePage';}
        print '">';
        print '<a href="form.php">Requests</a>';
        print '</li>';
        
        print '<li class="';
        if($path_parts['filename'] == 'about') {
            print 'activePage';}
        print '">';
        print '<a href="about.php">About</a>';
        print '</li>';
        
        ?>
    </ol>
</nav>

<?php

// ############ Sidebar Images ##################//

$leftPaths = [];
$rightPaths = [];

$characterPaths = getImagePathArray('images/', 'characters');
shuffle($characterPaths); //randomize order of characters on side
for($i = 0; $i < count($characterPaths); $i++) {
    if($i % 2 == 0) {
        $leftPaths[] = $characterPaths[$i];
    } else {
        $rightPaths[] = $characterPaths[$i];
    }
    
}




//container for right side images
print '<aside class="characterContainerLeft">';
//create image elements
for($i = 0; $i < count($leftPaths); $i++) {
    print '<img class="characterLeft"';
    print 'src="'. $leftPaths[$i] . '" alt="">';
}
print '</aside>';




//container for right side images
print '<aside class="characterContainerRight">';
//create image elements
for($i = 0; $i < count($rightPaths); $i++) {
    print '<img class="characterRight"';
    print 'src="'. $rightPaths[$i] . '" alt="">';
}
print '</aside>';
?>

<!-- ####################    End of  Nav   ############################ -->