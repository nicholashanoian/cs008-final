<!-- ####################    Start of  Nav   ############################ -->

<nav>
    <ol>
        <?php
        
        
        
        
        print '<li class="';
        if($path_parts['filename'] == 'roleplay') {
            print 'activePage';
        }
        print '">';
        print '<a href="roleplay.php">Role-Play Games</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'shooters') {
            print 'activePage';
        }
        print '">';
        print '<a href="shooters.php">Shooters</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'sports') {
            print 'activePage';
        }
        print '">';
        print '<a href="sports.php">Sports</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'form') {
            print 'activePage';
        }
        print '">';
        print '<a href="form.php">Join</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'news') {
            print 'activePage';
        }
        print '">';
        print '<a href="news.php">News</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'weather') {
            print 'activePage';
        }
        print '">';
        print '<a href="weather.php">Weather</a>';
        print '</li>';
        
        ?>
    </ol>
</nav>

<!-- ####################    End of  Nav   ############################ -->