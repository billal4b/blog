<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">
        <p><b> Comment Management</b></p>
    </div>
</header>
  <hr>

  <div class="w3-container">    
  
    <div class="w3-responsive">
        <?php include 'comment-server.php';    ?>       
        <span class="w3-red w3-card" id="deleteID"></span> 
        <table id="customers">
            <tr>
                <th>Post Title</th>
                <th>Comment</th>
                <th>Commenter Name</th>
                <th style="width:10px">Status</th>
                <th>Action</th>
            </tr>  
        <?php
            while ($row  = $result->fetch_assoc()) {
                $cid[$row["id"]] = $row["id"];
                $pid[$row["id"]] = $row["p_title"];
                $cmt[$row["id"]] = $row["comment"];
                $cmn[$row["id"]] = $row["commenter_name"];
                $eml[$row["id"]] = $row["email"];
                $tim[$row["id"]] = $row["date_time"];
                $sta[$row["id"]] = $row["is_active"];
        ?>
          <tr>
              <td><?php  echo $row["p_title"];?></td>
              <td><?php  echo $row["comment"] ;?></td>
              <td><?php  echo $row["commenter_name"] ;?></td>
              <td>
              <div class="w3-panel w3-<?php echo $row["is_active"] == 1 ? 'green' : 'red' ?>">
                 <?php  echo $row["is_active"] == 1 ? 'Show' : 'Not Show';?></div>           
              </td>
              <td>  
              <p>
              <button onclick="viewComment(<?php echo $row["id"]; ?>)" class="w3-button w3-orange"><i class="fa fa-eye">  </i></button> 
              <button onclick="deleteComment(<?php echo $row["id"]; ?>)" class="w3-button w3-red"><i class="fa fa-trash">  </i></button> 
              </p> 
              </td>
          </tr>
          
          <?php }  ?> 

        
        </table>
    </div>

</div>
<script>
    // get data into modal && change status
 function viewComment(id){
      document.getElementById("eid").value = id; 
      var pidj = <?php echo json_encode($pid); ?>;
      var cmtj = <?php echo json_encode($cmt); ?>;
      var emnj = <?php echo json_encode($cmn); ?>;
      var emaj = <?php echo json_encode($eml); ?>;
      var timj = <?php echo json_encode($tim); ?>;
      var staj = <?php echo json_encode($sta); ?>;
    
    document.getElementById("post_id").innerHTML = pidj[id];
    document.getElementById("comment").innerHTML = cmtj[id];
    document.getElementById("com_name").innerHTML = emnj[id];
    document.getElementById("email").innerHTML = emaj[id];
    document.getElementById("time").innerHTML = timj[id];
    document.getElementById('idView').style.display = 'block'; 

    var xhttp; 
    var id = document.getElementById("eid").value;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {        
           // document.getElementById("successUp").innerHTML = this.responseText;    
        }
    };
    xhttp.open("POST", "comment-server.php?i="+id, true);
    xhttp.send(); 
}
// delete record 
function deleteComment(id) {   
    var ok = confirm("Are you sure to Delete?");
    if (ok) {
        var xhttp; 
        xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {    
                document.getElementById("deleteID").innerHTML = this.responseText; 
                setTimeout(function(){ 
	                window.location.href = "dashboard.php?page_activity=6";            
	         }, 3000);  
            }
        };
        xhttp.open("DELETE", "comment-server.php?id="+id, true);
        xhttp.send();
    }  
}
</script>

<!--  Model -->
<div id="idView" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">   
      <header class="w3-container w3-teal"> 
      <a href="<?php echo $url; ?>" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal"> × </a>
        <h3>Comment Details</h3>
      </header>

        <div class="w3-section">
          <input type = "hidden" name ="eid" id ="eid" >
            <table class="w3-table-all">
                <tbody>
                    <tr>
                        <th > Post Title </th>
                        <td id="post_id"> </td>
                    </tr>
                    <tr>
                        <th > Comment </th>
                        <td id="comment"></td>
                    </tr>
                    <tr>
                        <th > Commenter Name </th>
                        <td id="com_name"></td>
                    </tr>
                    <tr>
                        <th > Email </th>
                        <td id="email"></td>
                    </tr>
                    <tr>
                        <th > Time </th>
                        <td id="time"></td>
                    </tr>               
                </tbody>
            </table>                   
        </div>
    </div>
</div>

