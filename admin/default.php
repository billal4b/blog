<?php
  if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
		exit();
  }
?>
<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>


  <hr>
<div class="w3-container">  
  <div class="w3-half">
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
          <a href="dashboard.php?page_activity=1">
              <div class="w3-container w3-teal  w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                <div class="w3-right">
                  <h3>
                  <?php 
                        include '../db_connect.php'; 
                        $sql = "SELECT * FROM tbl_users";
                        $connStatus = $conn->query($sql);
                        $numberOfRows = mysqli_num_rows($connStatus);                  
                        echo $numberOfRows;              
                    ?>
                  </h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Users</h4>
              </div>
          </a>    
        </div>

        <div class="w3-half">
          <a href="dashboard.php?page_activity=3">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
              <div class="w3-left"><i class="fa fa-tree w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3>
                <?php 
                        include '../db_connect.php'; 
                        $sql = "SELECT * FROM tbl_category";
                        $connStatus = $conn->query($sql);
                        $numberOfRows = mysqli_num_rows($connStatus);                  
                        echo $numberOfRows;              
                    ?>
                </h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Category</h4>
            </div>
          </a>
        </div>  
      </div>
      
      <div class="w3-row-padding w3-margin-bottom">

        <div class="w3-half">
          <a href="dashboard.php?page_activity=4">
            <div class="w3-container w3-blue w3-padding-16">
              <div class="w3-left"><i class="fa fa-file w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3>
                <?php 
                        include '../db_connect.php'; 
                        $sql = "SELECT * FROM tbl_post";
                        $connStatus = $conn->query($sql);
                        $numberOfRows = mysqli_num_rows($connStatus);                  
                        echo $numberOfRows;              
                    ?>
                </h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Blog Post</h4>
            </div>
          </a>
        </div>

        <div class="w3-half">
          <a href="dashboard.php?page_activity=6">
            <div class="w3-container w3-green w3-padding-16">
              <div class="w3-left"><i class="fa fa-comments w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3>
                    <?php 
                        include '../db_connect.php'; 
                        $sql = "SELECT * FROM tbl_comment";
                        $connStatus = $conn->query($sql);
                        $numberOfRows = mysqli_num_rows($connStatus);                  
                        echo $numberOfRows;              
                    ?>
                </h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Comments</h4>
            </div>
          </a>
        </div>  

      </div>

      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
          <a href="dashboard.php?page_activity=7">
              <div class="w3-container w3-deep-orange w3-padding-16">
                <div class="w3-left"><i class="fa fa-image w3-xxxlarge"></i></div>
                <div class="w3-right">
                  <h3>
                    <?php 
                        include '../db_connect.php'; 
                        $sql = "SELECT * FROM tbl_media";
                        $connStatus = $conn->query($sql);
                        $numberOfRows = mysqli_num_rows($connStatus);                  
                        echo $numberOfRows;              
                    ?>
                  </h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Media</h4>
              </div>
          </a>
        </div>

        <div class="w3-half">
          <a href='dashboard.php?page_activity=2'>
            <div class="w3-container w3-teal w3-padding-16">
              <div class="w3-left"><i class="fa fa-building w3-xxxlarge"></i></div>
              <div class="w3-right">
                <h3>
                    <?php 
                        include '../db_connect.php'; 
                        $sql = "SELECT * FROM tbl_company";  $connStatus = $conn->query($sql);
                        $numberOfRows = mysqli_num_rows($connStatus);   
                        echo $numberOfRows;            
                    ?>
                </h3>
              </div>
              <div class="w3-clear"></div>
              <h4>Company</h4>
            </div>
          </a>
        </div>  
      </div>
   </div>

   <div class="w3-half">
      <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
          <canvas id="canvas" width="300" height="300" style="background-color:#333">  </canvas>
            <script>
                var canvas = document.getElementById("canvas");
                var ctx = canvas.getContext("2d");
                var radius = canvas.height / 2;
                ctx.translate(radius, radius);
                radius = radius * 0.90
                setInterval(drawClock, 1000);

                function drawClock() {
                  drawFace(ctx, radius);
                  drawNumbers(ctx, radius);
                  drawTime(ctx, radius);
                }

                function drawFace(ctx, radius) {
                  var grad;
                  ctx.beginPath();
                  ctx.arc(0, 0, radius, 0, 2*Math.PI);
                  ctx.fillStyle = 'white';
                  ctx.fill();
                  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
                  grad.addColorStop(0, '#333');
                  grad.addColorStop(0.5, 'white');
                  grad.addColorStop(1, '#333');
                  ctx.strokeStyle = grad;
                  ctx.lineWidth = radius*0.1;
                  ctx.stroke();
                  ctx.beginPath();
                  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
                  ctx.fillStyle = '#333';
                  ctx.fill();
                }

                function drawNumbers(ctx, radius) {
                  var ang;
                  var num;
                  ctx.font = radius*0.15 + "px arial";
                  ctx.textBaseline="middle";
                  ctx.textAlign="center";
                  for(num = 1; num < 13; num++){
                    ang = num * Math.PI / 6;
                    ctx.rotate(ang);
                    ctx.translate(0, -radius*0.85);
                    ctx.rotate(-ang);
                    ctx.fillText(num.toString(), 0, 0);
                    ctx.rotate(ang);
                    ctx.translate(0, radius*0.85);
                    ctx.rotate(-ang);
                  }
                }

                function drawTime(ctx, radius){
                    var now = new Date();
                    var hour = now.getHours();
                    var minute = now.getMinutes();
                    var second = now.getSeconds();
                    //hour
                    hour=hour%12;
                    hour=(hour*Math.PI/6)+
                    (minute*Math.PI/(6*60))+
                    (second*Math.PI/(360*60));
                    drawHand(ctx, hour, radius*0.5, radius*0.07);
                    //minute
                    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
                    drawHand(ctx, minute, radius*0.8, radius*0.07);
                    // second
                    second=(second*Math.PI/30);
                    drawHand(ctx, second, radius*0.9, radius*0.02);
                }

                function drawHand(ctx, pos, length, width) {
                    ctx.beginPath();
                    ctx.lineWidth = width;
                    ctx.lineCap = "round";
                    ctx.moveTo(0,0);
                    ctx.rotate(pos);
                    ctx.lineTo(0, -length);
                    ctx.stroke();
                    ctx.rotate(-pos);
                }
            </script>
          </div>
          <div class="w3-half">
          
          </div>
      </div>
  </div>

</div>

 