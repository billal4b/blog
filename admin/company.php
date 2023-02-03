
<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">
        <p><b> Company Management</b>
       <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal w3-right">New Add</button> </p>
    </div>
</header>
  <hr>
    
  <div class="w3-container"> 
  
    <div class="w3-responsive">
        <?php    
            include '../db_connect.php';
            
            if($stmt = $conn->prepare("SELECT * FROM tbl_company WHERE id > ? ")) {
                $stmt->bind_param('i',$company_id);
            } else {
                printf("Errormessage: %s\n", $conn->error);
            }
            $company_id = 0;  
            $stmt->execute();
            $result = $stmt->get_result();                
            $stmt->close();
            $conn->close();
        
        ?>       
        <span class="w3-red w3-card" id="deleteID"></span> 
        <table id="customers">
            <tr>
                <th>Company</th>
                <th>Category</th>
                <th>Description</th>
                <th>Location</th>
                <th>Contact</th>
                <th style="width:10px">Status</th>
                <th>Action</th>
            </tr>  
        <?php
            while ($row  = $result->fetch_assoc()) {
                $cid[$row["id"]] = $row["id"];
                $cnm[$row["id"]] = $row["name"];
                $ctg[$row["id"]] = $row["category"];
                $des[$row["id"]] = $row["description"];
                $loc[$row["id"]] = $row["location"];
                $con[$row["id"]] = $row["contact"];
                $sta[$row["id"]] = $row["is_active"];
        ?>
          <tr>
              <td><?php  echo $row["name"];?></td>
              <td><?php  echo $row["category"] ;?></td>
              <td><?php  echo $row["description"] ;?></td>
              <td><?php  echo $row["location"] ;?></td>
              <td><?php  echo $row["contact"] ;?></td>
              <td>
              <div class="w3-panel w3-<?php echo $row["is_active"] == 1 ? 'green' : 'orange' ?>">
                 <?php  echo $row["is_active"] == 1 ? 'Active' : 'Inactive';?></div>           
              </td>
              <td>  
              <p>
              <button onclick="updateInfo(<?php echo $row["id"];?>)" class="w3-button w3-teal"><i class="fa fa-edit"></i></button> 
              <button onclick="deleteCom(<?php echo $row["id"];?>)" class="w3-button w3-red"><i class="fa fa-trash"></i></button> 
              </p> 
              </td>
          </tr>
          
          <?php }  ?> 

        
        </table>
    </div>

</div>
<script>
 function updateInfo(id){
    document.getElementById("eid").value = id; 
      var cnmj = <?php echo json_encode($cnm); ?>;
      //console.log('cnmj', cnmj);   
      var ctgj = <?php echo json_encode($ctg); ?>;
      var desj = <?php echo json_encode($des); ?>;
      var locj = <?php echo json_encode($loc); ?>;
      var conj = <?php echo json_encode($con); ?>;
      var staj = <?php echo json_encode($sta); ?>;
    
    document.getElementById("cname").value = cnmj[id];
    document.getElementById("category").value = ctgj[id];
    document.getElementById("description").value = desj[id];
    document.getElementById("location").value = locj[id];
    document.getElementById("contact").value = conj[id];
    document.getElementById("status").value = staj[id];     
    document.getElementById('idUemly').style.display='block'; 
}
</script>

<!-- Update Form Model -->

<div id="idUemly" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">    
      <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('idUemly').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <h3>Update Company</h3>
      </header>

      <form class="w3-container">
        <div class="w3-section">
          <p class="w3-green"> <span id="successUp"></span></p>  
          <input type = "hidden" name ="eid" id ="eid" >
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="cname" id="cname" placeholder="Enter Company Name" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="category" id="category" placeholder="Enter Category" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="description" id="description" placeholder="Enter Description" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="location" id="location" placeholder="Enter Location" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="contact" id="contact" placeholder="Enter Contact" required/>
          <select class="w3-input w3-border w3-margin-bottom" id="status"/>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
          </select>   
                  
          <button onclick="updateCom()" class="w3-btn w3-padding w3-teal w3-wide w3-section" type="button">Update</button>
        </div>
      </form>
    </div>
  </div>
<script>
function updateCom() {   
  var xhttp; 
  var cnmx = document.getElementById("cname").value; 
  var ctgx = document.getElementById("category").value; 
  var desx = document.getElementById("description").value; 
  var locx = document.getElementById("location").value;
  var conx = document.getElementById("contact").value; 
  var stax = document.getElementById("status").value;
  var cidx = document.getElementById("eid").value;

  xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {        
      document.getElementById("successUp").innerHTML = this.responseText;   
        setTimeout(function(){ 
	        window.location.href = "dashboard.php?page_activity=2";            
	  }, 3000);
    }
  };
  xhttp.open("GET", "company-server.php?na="+cnmx+"&ct="+ctgx+"&ds="+desx+"&lo="+locx+"&cn="+conx+"&st="+stax+"&id="+cidx, true);
  xhttp.send();  
	
}
// delete record 
function deleteCom(id) {   
    var ok = confirm("Are you sure to Delete?");
    if (ok) {
        var xhttp; 
        xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {    
                document.getElementById("deleteID").innerHTML = this.responseText; 
                setTimeout(function(){ 
	                window.location.href = "dashboard.php?page_activity=2";            
	         }, 3000);  
            }
        };
        xhttp.open("DELETE", "company-server.php?id="+id, true);
        xhttp.send();
    }  
}

</script>

<!-- insert Form Model -->

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">    
      <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <h3>Add New Company</h3>
      </header>

      <form class="w3-container" id="addData">
        <div class="w3-section">
        <div id="info"></div>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="cname" id="cname" placeholder="Enter Company Name" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="category" id="category" placeholder="Enter Category" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="description" id="description" placeholder="Enter Description" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="location" id="location" placeholder="Enter Location" required/>
          <input class="w3-input w3-border w3-margin-bottom" type="text" name="contact" id="contact" placeholder="Enter Contact" required/>
          <select class="w3-input w3-border w3-margin-bottom" name="status" id="status"/>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
          </select>   
                  
          <button class="w3-btn w3-padding w3-teal w3-wide w3-section" type="submit" name="save" id="save">Send</button>
        </div>
      </form>
    </div>
  </div>
  
<script>
// insert Form
$(document).ready(function(){
        $("#addData").validate({
            debug: true,
            rules: {
                cname: {
                    required: true
                },
                category: {
                    required: true
                },
                description: {
                    required: true
                },
                location: {
                    required: true
                },
                contact: {
                    required: true
                },
                
            },           
            submitHandler: subform
        })
        
        function subform(){
            var data = $("#addData").serialize();
            $.ajax({
                type: 'POST',
                url: 'company-server.php',
                data: data,
                beforeSend: function(){
                    $("#info").fadeOut();
                    $("#save").html("Sending ..... ");
                },
                success: function(resp){                   
                        $("#info").fadeIn(1000, function(){
                           setTimeout('window.location.href = "dashboard.php?page_activity=2";',3000);
                            $("#info").html("<div class='w3-panel w3-green'>"+resp+"</div>");
                            $("#save").html('Send');
                        })
                   
                }
            })
        }
    })

    // delete info

</script>


