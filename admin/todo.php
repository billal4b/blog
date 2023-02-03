<link rel="stylesheet" href="../assets/css/todo.css">

<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">      
      <p style="text-align:center">       
       <button onclick="document.getElementById('idgroup').style.display='block'" class="w3-button w3-teal w3-left">New Add To Do Group</button> 
       <b> To Do List</b>
       <button onclick="document.getElementById('idtodo').style.display='block'" class="w3-button w3-teal w3-right">New Add</button> 
       </p>
    </div>
</header>
<hr>

<div class="w3-container">   
  <div class="w3-responsive">
      <?php include 'todo-server.php'; ?>          
      <span class="w3-red w3-card" id="deleteID"></span> 
      <table id="customers">
          <tr>
              <th>To do Name</th>     
              <th>Group</th>              
              <th>Action</th>
          </tr>  
        <?php
          while ($row = $result->fetch_assoc()) {
            $tdid[$row["id"]] = $row["id"];
            $sname[$row["id"]] = $row["site_url"];
            $sname[$row["id"]] = $row["site_name"];
            $sname[$row["id"]] = $row["site_group"];
        ?>
        <tr>
            <td> <a href="<?php echo $row["site_url"]; ?>" target="_blank"> <?php echo $row["site_name"]; ?></a> </td>  
            <td> <?php echo $row["site_group"]; ?> </td>           
            <td>  
              <p>
                <button onclick="updateMedia(<?php echo $row['id']; ?>)" class="w3-button w3-teal"><i class="fa fa-edit"></i></button> 
                <button onclick="deleteMedia(<?php echo $row['id']; ?>)" class="w3-button w3-red"><i class="fa fa-trash"></i></button> 
              </p> 
            </td>
        </tr>
        
        <?php } ?>       
      </table>
  </div>
</div>

<!-- insert to do group model --> 
<div id="idgroup" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">    
      <header class="w3-container w3-teal"> 
      <h3>Group list</h3>
      <span onclick="document.getElementById('idgroup').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </header>

      <div id="addGroup" class="addGroup">
        <form class="w3-container" id="todoGroup" enctype="multipart/form-data">
          <div class="w3-section">  
            <div id="myDIV" class="header">          
              <input type="text" id="myInput" placeholder="Group name..">
              <span onclick="newElement()" class="addBtn">Add</span>
            </div>               
          </div>
        </form> 
      </div>
      <div class="w3-container" id="listGroup">
        <ul class="w3-ul w3-card" id="myUL" style="margin-buttom:10px;">
            <?php              
                include 'todo-group-server.php'; 
                while ($row = $groups -> fetch_assoc()) {
                  $grpid[$row["id"]]   = $row["id"];
                  $grpname[$row["id"]] = $row["group_name"];
                
              ?>

            <li onclick="deleteGroup(<?php echo $row['id']; ?>)"> <?php echo $row["group_name"]; ?> </li>

            <?php  }   ?>

        </ul>

      </div>      
      
      

         
    </div>

   
</div>

<script src="../assets/js/todo.js"></script>
