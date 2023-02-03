
  <!-- Top container -->
  <div class="w3-bar w3-top" style="z-index:4;background-color:#284c5d;color:white;">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i></button>
    <span class="w3-bar-item w3-left"><a href="dashboard.php" class="w3-button"><b>BR</b> Blog</a></span>
    <span class="w3-bar-item w3-right"> <a href="logout.php" class="w3-button">Log out </a></span>
  </div>

  <!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-sand w3-card " style="z-index:3;width:250px;" id="mySidebar"><br><br>  
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="dashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-indent fa-fw"></i>  Dashboard</a> 
    <a href="dashboard.php?page_activity=1" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  Users</a>     
    <a href="dashboard.php?page_activity=3" class="w3-bar-item w3-button w3-padding"><i class="fa fa-tree fa-fw"></i>  Category</a>
    <a href="dashboard.php?page_activity=4" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file fa-fw"></i>  Post</a>     
    <a href="dashboard.php?page_activity=5" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pagelines fa-fw"></i>  Page</a>     
    <a href="dashboard.php?page_activity=6" class="w3-bar-item w3-button w3-padding"><i class="fa fa-comments fa-fw"></i>  Comment</a>
    <a href="dashboard.php?page_activity=7" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file-text fa-fw"></i>  Media File</a>
    <a href="dashboard.php?page_activity=8" class="w3-bar-item w3-button w3-padding"><i class="fa fa-image fa-fw"></i>  Media Gallary</a>
    <a href="dashboard.php?page_activity=9" class="w3-bar-item w3-button w3-padding"><i class="fa fa-tasks fa-fw"></i>  To Do List</a>
    <a href="dashboard.php?page_activity=2" class="w3-bar-item w3-button w3-padding"><i class="fa fa-building fa-fw"></i>  Company</a><br><br>	    
  </div>
</nav>
 <!-- Overlay effect when opening sidebar on small screens -->
 <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

 <script>
/*
jQuery(document).ready(function($){
    var path = window.location.pathname.split("/").pop();     
    var url = window.location.href.substr(39);
    var res = path.concat(url);       
    if ( path == '' ) {
      path = 'dashboard.php';
    }        
    var target = $('nav a[href="'+res+'"]');
      target.addClass('active');
  });
*/
jQuery(document).ready(function($){
    var path = window.location.pathname.split("/").pop();    
    var url = window.location.href;
    path = ((n = url.indexOf('?') )!== -1)? path.concat('\?'+url.substr(++n)): path;
    path = ( path === '' )? 'dashboard.php': path;
    $('nav a[href="'+path+'"]').addClass('active');    
  }); 
  
</script>