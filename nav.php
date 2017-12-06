<!-- ####################    Start of  Nav   ############################ -->



<nav id="topnav">
    <ol>
        <?php
        
        
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'roleplay') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=roleplay">Role-Play</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'action') {
            print 'activePage';}    
        print '">';
        print '<a href="genre.php?genre=action">Action</a>';
        print '</li>';
        
        print '<li class="';
        if($path_parts['filename'] == 'index') {
            print 'activePage';}
        print '">';
        print '<a href="index.php">Home</a>';
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

$yInitial = 150;
$yOffset = 200;

print '<div class="characterContainerLeft">';

$characterPaths = getImagePathArray('images/', 'characters-left');
for($i = 0; $i < count($characterPaths); $i++) {
    print '<img class="characterLeft" style="top:'. ($yInitial + ($yOffset * $i)) .'px;"';
    print 'src="'. $characterPaths[$i] . '">';
}

print '</div>';


print '<div class="characterContainerRight">';

$characterPaths = getImagePathArray('images/', 'characters-right');
for($i = 0; $i < count($characterPaths); $i++) {
    print '<img class="characterRight" style="top:'. ($yInitial + ($yOffset * $i)) .'px;"';
    print 'src="'. $characterPaths[$i] . '">';
}

print '</div>';
?>

<!-- ####################    End of  Nav   ############################ -->