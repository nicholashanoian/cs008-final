<!-- ####################    Start of  footer   ############################ -->

<footer>
    <div class="footerContent"><p><a class="footerLink" href="index.php">VGDB</a><span class="footerCredits">Designed by Nicholas Hanoian and Chris McCabe</span></p></div>
</footer>




<script>
var slideIndex = 0;
var slidesTimer;

if(location.pathname === '/cs008/cs008-final/game.php') {
    setImg(0);
}

function moveImg(n) {
    //initialize index
    var i; 
    //get all images in slides
    var x = document.getElementsByClassName("screenshotSlides");
    //get all buttons from slider
    var dots = document.getElementsByClassName("dot");
    
    //hide all images
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    //remove active button class from all buttons
    for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" activeButton", "");
    }
    
    //move to next (or previous if n = -1) image
    slideIndex += n;
    
    //if index is greater than the number of images, go back to start
    if (slideIndex > x.length-1) {slideIndex = 0} 
    //if index is less than 0, go to the end
    if (slideIndex < 0) {slideIndex = x.length-1}
    
    //show current image
    x[slideIndex].style.display = "block"; 
    //add activeButton class to current slide's button
    dots[slideIndex].className += " activeButton";
    
    //clear and reset timer to go to next image after 3 seconds
    clearInterval(slidesTimer);
    slidesTimer = setInterval('moveImg(1)', 3000);
}

function setImg(n) {
    var i;
    var x = document.getElementsByClassName("screenshotSlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex = n;
    for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" activeButton", "");
    }
    x[slideIndex].style.display = "block"; 
    dots[slideIndex].className += " activeButton";
    clearInterval(slidesTimer);
    slidesTimer = setInterval('moveImg(1)', 3000);
}

</script>
<!-- ####################    End of  footer     ############################ -->