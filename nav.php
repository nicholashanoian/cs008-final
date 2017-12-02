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
        if($path_parts['filename'] == 'genre' AND $genre == 'shooter') {
            print 'activePage';}    
        print '">';
        print '<a href="genre.php?genre=shooter">Shooters</a>';
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



<nav id="navbar">
    <ol>
        <?php
        
        
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'roleplay') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=roleplay">Role-Play</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'genre' AND $genre == 'shooter') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=shooter">Shooters</a>';
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

<!-- ####################    End of  Nav   ############################ -->