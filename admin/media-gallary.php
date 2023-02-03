<link rel="stylesheet" href="../assets/css/lightbox.css">
<script src="../assets/js/jquery.form.min.js"></script>
 
<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar"> <p><b> Media Gallary</b></div>
</header>

  <hr>

<div class="w3-container">     
    <div class="w3-responsive">
      <!-- Images used to open the lightbox -->
        <div class="row">
          <div class="column">
            <img src="https://www.w3schools.com/howto/img_nature.jpg" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
          </div>
          <div class="column">
            <img src="https://www.w3schools.com/howto/img_snow.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
          </div>
          <div class="column">
            <img src="https://www.w3schools.com/howto/img_mountains.jpg" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
          </div>
          <div class="column">
            <img src="https://www.w3schools.com/howto/img_lights.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
          </div>
          
        </div>
   </div>
</div>


        <!-- The Modal/Lightbox -->

        <div id="myModal" class="modal">
          <span class="close cursor" onclick="closeModal()">&times;</span>

          <div class="modal-content">

            <div class="mySlides">
              <img src="https://www.w3schools.com/howto/img_nature_wide.jpg" style="width:100%">
            </div>

            <div class="mySlides">
              <img src="https://www.w3schools.com/howto/img_snow_wide.jpg" style="width:100%">
            </div>

            <div class="mySlides">
              <img src="https://www.w3schools.com/howto/img_mountains_wide.jpg" style="width:100%">
            </div>
            
            <div class="mySlides">
              <img src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%">
            </div>
            
            <!-- Next/previous controls -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

             <!-- Caption text -->

            <div class="caption-container">
              <p id="caption"></p>
            </div>

            <!-- Thumbnail image controls -->
            <div class="column">
              <img class="demo cursor" src="https://www.w3schools.com/howto/img_nature_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
            </div>
            <div class="column">
              <img class="demo cursor" src="https://www.w3schools.com/howto/img_snow_wide.jpg" style="width:100%"  onclick="currentSlide(2)" alt="Snow">
            </div>
            <div class="column">
              <img class="demo cursor" src="https://www.w3schools.com/howto/img_mountains_wide.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
            </div>
            <div class="column">
              <img class="demo cursor" src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
            </div>

             <!-- Next/previous controls -->
          
            
          </div>
        </div>

 


<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

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
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

</script>

