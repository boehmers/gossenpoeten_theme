<script>
function openModal(postId) {
    document.getElementById('myModal'+postId).style.display = "block";
}

function closeModal(postId) {
    document.getElementById('myModal'+postId).style.display = "none";
}

var slideIndex = 1;


function plusSlides(n, postId) {
    showSlides(slideIndex += n, postId);
}

function currentSlide(n, postId) {
    showSlides(slideIndex = n, postId);
}

function showSlides(n,postId) {
    var i;
    var slides = document.getElementsByName("slides"+postId);
    var dots = document.getElementsByClassName("demo");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}
</script>