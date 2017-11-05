<!-- ####################    Start of  Nav   ############################ -->

<nav>
    <ol>
        <?php
        
        
        
        
        print '<li class="';
        if($path_parts['filename'] == 'art') {
            print 'activePage';
        }
        print '">';
        print '<a href="art.php">Art</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'contest') {
            print 'activePage';
        }
        print '">';
        print '<a href="contest.php">Contest</a>';
        print '</li>';
        
        
        print '<li class="';
        if($path_parts['filename'] == 'index') {
            print 'activePage';
        }
        print '">';
        print '<a href="index.php">Home</a>';
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

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="../js/jquery.flexslider.js"></script>

        <script type="text/javascript">
            var flexsliderStylesLocation = "../css/flexslider.css";
            $('<link rel="stylesheet" type="text/css" href="' + flexsliderStylesLocation + '" >').appendTo("head");
            $(window).load(function () {

                $('.flexslider').flexslider({
                    animation: "fade",
                    slideshowSpeed: 3000,
                    animationSpeed: 1000
                });

            });
        </script>


<!-- slider images sourced from Google images-->

        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="../images/slider-new/img1.jpg" alt="" >
                </li>
                <li>
                    <img src="../images/slider-new/img2.jpg" alt="" >
                </li>

                <li>
                    <img src="../images/slider-new/img3.jpg" alt="" >
                </li>

                <li>
                    <img src="../images/slider-new/img4.jpg" alt="" >
                </li>

                <li>
                    <img src="../images/slider-new/img5.jpg" alt="" >
                </li>
                
                <li>
                    <img src="../images/slider-new/img6.jpg" alt="" >
                </li>

            </ul>
        </div>

<!-- ####################    End of  Nav   ############################ -->