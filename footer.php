<!-- ####################    Start of  footer   ############################ -->

<footer>
    <div class="footerContent"><p><a class="footerLink" href="index.php">VGDB</a><span class="footerCredits">Designed by Nicholas Hanoian and Chris McCabe</span></p></div>
</footer>




<script>
var slideIndex = 0;
var slidesTimer;


if(location.pathname == '/cs008-final/game.php') {
    startUp();
}


function startUp() {
    var i;
    var x = document.getElementsByClassName("screenshotSlides");
    var dots = document.getElementsByClassName("demo");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" activeButton", "");
    }
    x[0].style.display = "block";
    dots[slideIndex].className += " activeButton";
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
     dots[i].className = dots[i].className.replace(" activeButton", "");
    }
    if (slideIndex > x.length-1) {slideIndex = 0} 
    if (slideIndex < 0) {slideIndex = x.length-1}
    x[slideIndex].style.display = "block"; 
    dots[slideIndex].className += " activeButton";
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
     dots[i].className = dots[i].className.replace(" activeButton", "");
    }
    x[slideIndex].style.display = "block"; 
    dots[slideIndex].className += " activeButton";
    clearInterval(slidesTimer);
    slidesTimer = setInterval('moveImg(1)', 3000);
}





function setBorder() {
 
    footer = document.getElementsByTagName('footer');
    footerBox = footer[0].getBoundingClientRect();

    characterLefts = document.getElementsByClassName("characterLeft");
    characterRights = document.getElementsByClassName("characterRight");

    for (var i = 0; i < characterLefts.length; i++) {
        thisBox = characterLefts[i].getBoundingClientRect();    

        if(thisBox.top > footerBox.top) {
            characterLefts[i].className += " hidden";
        } else {
            characterLefts[i].className = characterLefts[i].className.replace(" hidden", "");
        }
    }

    for (var i = 0; i < characterRights.length; i++) {
        thisBox = characterRights[i].getBoundingClientRect();    

        if(thisBox.top+20 > footerBox.top) {
            characterRights[i].className += " hidden";
        } else {
            characterRights[i].className = characterRights[i].className.replace(" hidden", "");
        }
    }
    
}

window.onload = setBorder;
window.onresize = setBorder;












</script>
<!-- ####################    End of  footer     ############################ -->