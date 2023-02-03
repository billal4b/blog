<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">
        <p><b>Add New Post</b>
         <a href="dashboard.php?page_activity=4"><button class="w3-button w3-teal w3-right">Post List</button> </a>
        </p>
    </div>
</header>
  <hr>
  <div class="w3-container">  
    <div class=" w3-card container">
      <form id="addData" enctype="multipart/form-data" >
      
        <div class="row">
          <div class="col-25">
            <label for="title">Post Title</label>
          </div>
          <div class="col-75">
            <input type="text" id="title" name="title" placeholder="Your Post Title" required>
          </div>
        </div>
        <?php
        include '../db_connect.php';
        $sql = "SELECT id,title FROM tbl_category WHERE is_active = 1 ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        ?>
        <div class="row">
          <div class="col-25">
            <label for="category">Post Category</label>
          </div>
          <div class="col-75">
            <select id="category" name="category" required>
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {  ?>
                  <option value="<?php echo $row['id']; ?>"> <?php echo $row['title']; ?> </option>
                <?php

                }
              } else {
                echo "0 results";
              }
              ?>
            </select>
          </div>
        </div>
        <div id="info"></div>
        <div class="row">
          <div class="col-25">
            <label for="content">Post Content</label>
          </div>
          <div class="col-75">
            <textarea class="tinymce" id="content" name="content"></textarea>
          </div>
        </div><br/>
        <div class="row">
          <div class="col-25">
            <label for="date_time">Post Date</label>
          </div>
          <div class="col-75">
            <input type="date" id="date_time" name="date_time" required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="status">Publication Status</label>
          </div>
          <div class="col-75">
            <select id="status" name="status">
              <option value="1">Publish</option>
              <option value="0">Unpublish</option>
            </select>
          </div>
        </div><br/>    
       
        <div class="row">
          <button type="submit" id="save" name="save" class="w3-button w3-teal w3-right"> Submit Post</button>
        </div>
      </form>
  </div>
</div>  
<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
<script>

$(document).ready(function(){
        $("#addData").validate({
            debug: true,
            rules: {
                title: {
                    required: true
                },
                content: {
                    required: true
                },                
            },           
            submitHandler: subform
        })        
        function subform(){
            var data = $("#addData").serialize();
            $.ajax({
                type: 'POST',
                url: 'post-server.php',
                data: data,
                beforeSend: function(){
                    $("#info").fadeOut();
                    $("#save").html("Sending ..... ");
                },
                success: function(resp){                   
                    $("#info").fadeIn(1000, function(){
                        setTimeout('window.location.href = "dashboard.php?page_activity=4";',3000);
                        $("#info").html("<div class='w3-panel w3-green'>"+resp+"</div>");
                        $("#save").html('Send');
                    })                   
                }
            })
        }
    })
</script>