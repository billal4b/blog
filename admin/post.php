<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <div class="w3-bar">
        <p><b> Post Management</b>
       <a href="dashboard.php?page_activity=5"><button class="w3-button w3-teal w3-right">New Add</button> </a></p>
    </div>
</header>
  <hr>

  <div class="w3-container">      
    <div class="w3-responsive">    
        <?php    
            include '../db_connect.php';    
            if($stmt = $conn->prepare(" SELECT
                                            p.id, 
                                            p.p_title,
                                            p.content, 
                                            p.category_id,
                                            p.is_active,
                                            p.date_time, 
                                            c.title
                                        FROM 
                                            tbl_post p
                                        INNER JOIN 
                                            tbl_category c ON c.id = p.category_id
                                        WHERE 
                                            c.id > ?")) {
            $stmt->bind_param('i',$post_id);
            } else {
                printf("Errormessage: %s\n", $conn->error);
            } 
            $post_id = 0;  
            $stmt->execute();
            $result = $stmt->get_result();                
            $stmt->close();
            $conn->close();       
        ?>       
        <span class="w3-red w3-card" id="deleteID"></span> 
        <table id="customers">
            <tr>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Post Time</th>
                <th style="width:10px">Publication Status</th>
                <th>Action</th>
            </tr>  
        <?php
            while ($row  = $result->fetch_assoc()) {
                $cid[$row["id"]] = $row["id"];
                $tit[$row["id"]] = $row["p_title"];
                $cat[$row["id"]] = $row["title"];
                $cat[$row["id"]] = $row["date_time"];
                $sta[$row["id"]] = $row["is_active"];
        ?>
          <tr>
              <td><?php echo $row["p_title"];?></td>
              <td><?php echo $row["title"] ;?></td>
              <td><?php echo $row["date_time"] ;?></td>
              <td>
                <div class="w3-panel w3-<?php echo $row["is_active"] == 1 ? 'green' : 'orange' ?>">
                    <?php  echo $row["is_active"] == 1 ? 'Publish' : 'Unpublish';?></div>           
                </td>
              <td>  
                <p>
                    <button onclick="viewID(<?php echo $row["id"];?>)" class="w3-button w3-orange"><i class="fa fa-eye">  </i></button> 
                    <button onclick="updateInfo(<?php echo $row["id"];?>)" class="w3-button w3-teal"><i class="fa fa-edit">  </i></button> 
                    <button onclick="deleteID(<?php echo $row["id"];?>)" class="w3-button w3-red"><i class="fa fa-trash">  </i></button>               
                </p> 
              </td>
          </tr>
          
          <?php }  ?> 

        
        </table>
    </div>
    <div class="w3-center">
        <div class="w3-bar ">
            <a href="#" class="w3-button">«</a>
            <a href="#" class="w3-button w3-green">1</a>
            <a href="#" class="w3-button">2</a>
            <a href="#" class="w3-button">3</a>
            <a href="#" class="w3-button">4</a>
            <a href="#" class="w3-button">»</a>
        </div>
    </div>

</div>

