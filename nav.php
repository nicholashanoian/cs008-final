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
        
        ?>
    </ol>
</nav>

<?php

// ############ Sidebar Images ##################//



//container for right side images
print '<div class="characterContainerLeft">';

//get image paths from folder
$characterPaths = getImagePathArray('images/', 'characters-left');
shuffle($characterPaths); //randomize order of characters on side

//create image elements
for($i = 0; $i < count($characterPaths); $i++) {
    print '<img class="characterLeft"';
    print 'src="'. $characterPaths[$i] . '" alt="">';
}
print '</div>';




//container for right side images
print '<div class="characterContainerRight">';

//get image paths from folder
$characterPaths = getImagePathArray('images/', 'characters-right');

shuffle($characterPaths); //randomize order of characters on side

//create image elements
for($i = 0; $i < count($characterPaths); $i++) {
    print '<img class="characterRight"';
    print 'src="'. $characterPaths[$i] . '" alt="">';
}
print '</div>';
?>

<!-- ####################    End of  Nav   ############################ -->