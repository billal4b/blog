<link rel="stylesheet" href="../assets/css/lightbox.css">
<script src="../assets/js/jquery.form.min.js"></script>
  <style type="text/css">
    input[type=file]{
      display: inline;
    }
    #image_preview{
      padding: 5px;
    }
    #image_preview img {
      width: 150px;
      height: 150px;
      padding: 5px;
    }  
   
    #view td {
      text-align: center;
      padding: 15px;
    }
    .responsive {
      width: 100%;
      max-width: 400px;
      height: auto;
      max-height: 95vh;
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
      <?php   include '../db_connect.php';

      if ($stmt = $conn->prepare("SELECT * FROM tbl_media WHERE id > ? ")) {
        $stmt->bind_param('i', $media_id);
      } else {
        printf("Errormessage: %s\n", $conn->error);
      }
      $media_id = 0;
      $stmt->execute();
      $result = $stmt->get_result();
      $stmt->close();
      $conn->close();

      ?>       
      <span class="w3-red w3-card" id="deleteID"></span> 
      <table id="customers">
          <tr>
              <th>Type</th>
              <th>Title</th>
              <th>File</th>     
              <th style="width:10px">Status</th>
              <th>Action</th>
          </tr>  
      <?php
      while ($row = $result->fetch_assoc()) {
        $mid[$row["id"]] = $row["id"];
        $type[$row["id"]] = $row["file_type"];
        $title[$row["id"]] = $row["file_title"];
        $thumb[$row["id"]] = $row["file_url"];
        $status[$row["id"]] = $row["is_active"];
        ?>
        <tr>
            <td><?php echo $row['file_type'] == 1 ? 'Image' : ($row['file_type'] == 2 ? 'Video' : 'PDF'); ?></td>
            <td><?php echo $row["file_title"]; ?></td>
            
            <td> <img src="<?php echo $row["file_type"] == 1 ? $row["file_url"] : ($row["file_type"] == 2 ? '/assets/images/video-img.png' : '/assets/images/pdf-img.png'); ?>" width="50px" height="50px"> </td>
            <td>
            <div class="w3-panel w3-<?php echo $row["is_active"] == 1 ? 'green' : 'orange' ?>">
               <?php echo $row["is_active"] == 1 ? 'Active' : 'Inactive'; ?></div>           
            </td>
            <td>  
            <p>
            <button onclick="viewMedia(<?php echo $row["id"]; ?>)" class="w3-button w3-orange"><i class="fa fa-eye"></i></button> 
            <button onclick="updateMedia(<?php echo $row["id"]; ?>)" class="w3-button w3-teal"><i class="fa fa-edit"></i></button> 
            <button onclick="deleteMedia(<?php echo $row["id"]; ?>)" class="w3-button w3-red"><i class="fa fa-trash"></i></button> 
            </p> 
            </td>
        </tr>
        
     <?php } ?>       
      </table>

  </div>

</div>

<!-- insert box --> 
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">    
      <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <h3>Select your File Format</h3>
      </header>

      <form class="w3-container" id="formData" enctype="multipart/form-data">
        <div class="w3-section">
          
          <select class="w3-input w3-border w3-margin-bottom" name="type" id="type">
                <option value="1">Image</option>
                <option value="2">Video</option>
                <option value="3">PDF, Word</option>
          </select>  
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="title" id="title" placeholder="Enter Title" required/> 
          <input class="w3-input w3-border w3-margin-bottom" type="file" name="upFile" id="upFile" required/>
          <div id="info"></div>
          <div id="image_preview"></div>
          <button class="w3-btn w3-padding w3-teal w3-wide w3-section" type="submit" name="submit" id="submit">Upload</button>
        </div>
      </form>     

    </div>
  </div>

<script>
 function viewMedia(id){

    document.getElementById("eid").value = id; 

      var titlej = <?php echo json_encode($title); ?>;
      var thumbj = <?php echo json_encode($thumb); ?>;
/*
      var thumbv = thumbj[id];
      var ext = thumbv.split('.').pop();

      console.log( 'file path : ', thumbv);
      console.log( 'file extention : ', ext);
       window.location.href = "dashboard.php?page_activity=7?var=" +ext;
        */

    document.getElementById("viewTitle").innerHTML = titlej[id];
    document.getElementById("viewFile").src = thumbj[id];    

    document.getElementById('idMedia').style.display = 'block'; 
}

</script>

 <!-- view box -->
<div id="idMedia" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">   
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('idMedia').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <h3>View File</h3>
      </header>    

      <div class="w3-section">
      <input type = "hidden" name ="eid" id ="eid" >
        <table class="w3-table-all">
          <tbody id="view">
              <tr>
                  <th> Title </th>
                  <td id="viewTitle"> </td>
              </tr>
              <tr>
                  <th> File  </th>
                 
                  <td><img id="viewFile" src="viewFile" class="responsive"> </td>
              </tr>                            
          </tbody>
        </table>      
      </div>

    </div>
</div>


<script type="text/javascript">

$("#upFile").change(function() {

  $('#image_preview').html("");
  var total_file = document.getElementById("upFile").files.length;

  for(var i=0; i<total_file; i++) {
      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
  }
  
});

// insert data in server
  $(document).ready(function(){
          $("#formData").validate({
              debug: true,
              rules: {
                  title: {
                      required: true
                  },
                  upFile: {
                      required: true
                  },                
              },           
              submitHandler: subform
          });        
          function subform(){
              var formData = new FormData($('#formData')[0]);

              $.ajax({

                  type: 'POST',
                  url: 'media-server.php',
                  data: formData,
                  processData: false,
                  cache: false,  
                  contentType: false,

                  success: function(resp){                   
                      $("#info").fadeIn(1000, function(){
                          setTimeout('window.location.href = "dashboard.php?page_activity=7";',2000);
                          $("#info").html("<div class='w3-panel w3-green'>"+resp+"</div>");
                          $("#submit").html('Upload');
                      })                   
                  }
              });
          }
      }); 
  
</script>