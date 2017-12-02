<!-- ####################    Start of  footer   ############################ -->

<footer>
    <p>Designed by Nicholas Hanoian and Chris McCabe</p>
</footer>




<script>
var slideIndex = 0;
var slidesTimer;

startUp();


function startUp() {
    var i;
    var x = document.getElementsByClassName("screenshotSlides");
    var dots = document.getElementsByClassName("demo");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" activeSlide", "");
    }
    x[0].style.display = "block";
    dots[slideIndex].className += " activeSlide";
    setTimeout('moveImg(1)', 3000);
}



function moveImg(n) {
    var i;
    var x = document.getElementsByClassName("screenshotSlides");
    var dots = document.getElementsByClassName("demo");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex += n;
    for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" activeSlide", "");
    }
    if (slideIndex > x.length-1) {slideIndex = 0} 
    if (slideIndex < 0) {slideIndex = x.length-1}
    x[slideIndex].style.display = "block"; 
    dots[slideIndex].className += " activeSlide";
    clearInterval(slidesTimer);
    slidesTimer = setInterval('moveImg(1)', 3000);
    
    
}

function setImg(n) {
    var i;
    var x = document.getElementsByClassName("screenshotSlides");
    var dots = document.getElementsByClassName("demo");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex = n;
    for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" activeSlide", "");
    }
    x[slideIndex].style.display = "block"; 
    dots[slideIndex].className += " activeSlide";
    clearInterval(slidesTimer);
    slidesTimer = setInterval('moveImg(1)', 3000);
}

</script>
<!-- ####################    End of  footer     ############################ -->