<?php 
  if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
		exit();
  }
?>
<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">
        <p><b> User Management</b>
       <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal w3-right">New Add</button> </p>
    </div>
</header>
  <hr>
  <div class="w3-container">    
  
    <div class="w3-responsive">
        <?php    
            include '../db_connect.php';
            if($stmt = $conn->prepare("SELECT * FROM tbl_users WHERE id > ? ")) {
                $stmt->bind_param('i',$company_id);
            } else {
                printf("Errormessage: %s\n", $conn->error);
            }

            $company_id = 0;  
            $stmt->execute();
            $result = $stmt->get_result();

                $i = 0;

                while ($row  = $result->fetch_assoc()) {
                    $cid[$i] = $row["id"];
                    $nam[$i] = $row["name"];
                    $unm[$i] = $row["username"];
                    $eml[$i] = $row["email"];            
                    $sta[$i] = $row["is_active"];

                    $i++;
                }
            $stmt->close();
            $conn->close();
        
        ?>       
        <table id="customers">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>        
        <?php 
          for ( $j=0; $j<$i; $j++ ){            
             
          ?>
          <tr>
              <td><?php  echo $nam[$j] ;?></td>
              <td><?php  echo $unm[$j] ;?></td>
              <td><?php  echo $eml[$j] ;?></td>              
              <td>  
              <p><button onclick="updateInfo(<?php echo $cid[$j];?>)" class="w3-button w3-teal">Edit info</button> </p> 
              </td>
          </tr>
          
          <?php }  ?>
        
        

        </table>
    </div>

</div>




