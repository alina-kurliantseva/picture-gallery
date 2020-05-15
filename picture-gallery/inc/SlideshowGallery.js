$('#curentPictureIndex').val();
var slideIndex = $('#curentPictureIndex').val();
if(slideIndex == "")
    slideIndex = 1;
showSlides(slideIndex);
function plusSlides(n) {
    showSlides(slideIndex += n);
}
function currentSlide(n) {
    showSlides(slideIndex = n);
    console.log("why its not working alina");
    console.log($(this));
}
$('img.demo').on('click', function() {
    var index = $(this).data('index');
    showSlides(slideIndex = index);  
    var src = $(this).attr('src').split('/');
    var file = src[src.length - 1];
    $('#picture-name').val(file);
});
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    $('#curentPictureIndex').val(slideIndex);
    dots[slideIndex-1].className += " active";
}

