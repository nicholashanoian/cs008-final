<!-- ####################    Start of  Nav   ############################ -->






<nav id="navbar">
    <ol>
        <?php
        
        
        
        
        print '<li class="';
        if($path_parts['filename'] == 'roleplay') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=roleplay">RPGs</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'shooters') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=shooter">Shooters</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'sports') {
            print 'activePage';}
        print '">';
        print '<a href="genre.php?genre=sports">Sports</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'form') {
            print 'activePage';}
        print '">';
        print '<a href="form.php">Join</a>';
        print '</li>';
        
        ?>
    </ol>
</nav>

<!-- ####################    End of  Nav   ############################ -->