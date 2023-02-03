<link rel="stylesheet" href="../assets/css/lightbox.css">
<script src="../assets/js/jquery.form.min.js"></script>
  <style type="text/css">
    input[type=file]{
      display: inline;
    }
    #image_preview{
      padding: 5px;
    }
    #image_preview img{
      width: 150px;
      height: 150px;
      padding: 5px;
    }
  </style>

<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">
        <p><b> Media Management</b>
       <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal w3-right">New Add</button> </p>
    </div>
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

 


<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">    
      <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <h3>Select your File Format</h3>
      </header>

      <form class="w3-container"  action="media-server.php" id="formData" method="post"  enctype="multipart/form-data">
        <div class="w3-section">
          <div id="info"></div>
          <select class="w3-input w3-border w3-margin-bottom" name="type" id="type">
                <option value="1">Image</option>
                <option value="2">Video</option>
                <option value="3">PDF</option>
          </select>  
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="title" id="title" placeholder="Enter Title" required/> 
          <input class="w3-input w3-border w3-margin-bottom" type="file" name="uploadFile[]" id="uploadFile" multiple/>
          <div id="image_preview"></div>
          <button class="w3-btn w3-padding w3-teal w3-wide w3-section" type="submit" name="submitFile" id="submitFile">Upload</button>
        </div>
      </form>     

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


<script type="text/javascript">

$("#uploadFile").change(function() {

  $('#image_preview').html("");
  var total_file = document.getElementById("uploadFile").files.length;

  for(var i=0; i<total_file; i++) {
      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
  }
  
});

$('form').ajaxForm(function() { 
  alert("Uploaded SuccessFully");
});


  

// $(document).ready(function (e) {
//   $("#formData").on('submit',(function(e) {
//    e.preventDefault();
//    var postData = new FormData($("#formData")[0]);
//    alert(postData);

//     $.ajax({
//            url: "media-server.php",
//            type: "POST",
//            data:  postData,          
//            contentType: false,         
//            processData:false,       
//            success: function(resp){              
//               $("#info").html("<div class='w3-panel w3-green'>"+resp+"</div>");
//               $("#submit").html('Upload');
//            }   
                 
//         });
//     }));
// });

/*

  $(document).ready(function(){
          $("#formData").validate({
              debug: true,
              rules: {
                  title: {
                      required: true
                  },
                  file: {
                      required: true
                  },                
              },           
              submitHandler: subform
          })        
          function subform(){
              var data = $("#formData").serialize();
              var fd = new FormData();
              $.ajax({
                  type: 'POST',
                  url: 'media-server.php',
                  data: data,
                  processData: false,
                  cache: false,  
                  contentType: false,

                  success: function(resp){              
                        $("#info").html("<div class='w3-panel w3-green'>"+resp+"</div>");
                        $("#submit").html('Upload');
                  }
              })
          }
      }) */
  
</script>