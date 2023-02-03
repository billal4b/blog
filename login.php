<!DOCTYPE html>
<html>
<title>Login Blog Site</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/w3.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/w3-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .error{
        font-size: 12pt;
        color:darkred;
    }
</style>
<body>
<div class="w3-container w3-teal">
<h1>Personal Blog</h1>
</div>
<div id="wrapper">   
    <div class="w3-row " style="margin-top:50px" >
        <div align="center" >
            <div class="w3-row w3-card-4" style="max-width:450px;margin-top:10px">
                <div id="Login" class="w3-container logged">
                    <div id="info"></div>
                    <form id="myform" class="w3-text-blue w3-margin" method="post"> 
                        <div class="w3-container w3-teal"><h2>Log In</h2></div>                        
                        <div class="w3-row w3-section">   
                            <input class="w3-input w3-border w3-border-teal" id="email" name ="email" type="email" placeholder="Email address" required/>    
                        </div>
                        <div class="w3-row w3-section">   
                            <input id="password" class="w3-input w3-border w3-border-teal" name ="password" type="password" placeholder="Password" required/>    
                        </div>                       
                        <button id="login" class="w3-button w3-block w3-section w3-teal w3-ripple w3-padding w3-hover-blue-grey" name ="login" >Login</button>
                        <div class="w3-row w3-section">   
                            <a  onclick="document.getElementById('changeP').style.display='block'" class ="w3-text-teal w3-right" style="cursor:pointer"><span id = "fpass">Forgot your password?</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer">
    <div class="w3-row w3-footer-color" style="height:100%">
		  <div align = "center" class = "w3-display-middle">
		  Personal Blog
		  </div>
	</div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/validation.min.js"></script>
<script>
    $(document).ready(function(){
        $("#myform").validate({
            rules: {
                password: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
            },
            messages:{
                password: {
                    required: "Please Enter Password",
                },
                email: "Please Enter email"
            },
            submitHandler: subform
        })
        function subform(){
            var data = $("#myform").serialize();
            $.ajax({
                type: 'POST',
                url: 'login-server.php',
                data: data,
                beforeSend: function(){
                    $("#info").fadeOut();
                    $("#login").html(" Sending ..... ");
                },
                success: function(resp){
                    if(resp=="ok"){
                        $("#login").html("<img src='ajax-loader.gif' width='15'/> &nbsp; Login");
                        setTimeout('window.location.href = "admin/dashboard.php";',4000);
                    } else{
                        $("#info").fadeIn(1000, function(){
                            $("#info").html("<div class='w3-panel w3-red'>"+resp+"</div>");
                            $("#login").html('Login');
                        })
                    }
                }
            })
        }
    })
    </script>
</body>
</body>
</html>