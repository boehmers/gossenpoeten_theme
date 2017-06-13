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

    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[slideIndex-1].style.display = "block";

}
</script>