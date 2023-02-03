<?php 

if (isset($_GET["page_activity"])) {

	if( $_GET["page_activity"] == 1 ) {
		include("user.php");
	} else if ( $_GET["page_activity"] == 2 ) {
		include("company.php");
	} else if ( $_GET["page_activity"] == 3 ) {
		include ('category.php');
	} else if ( $_GET["page_activity"] == 4 ) {
		include ('post.php');
	} else if ( $_GET["page_activity"] == 5 ) {
		include ('post-form.php');
	} else if ( $_GET["page_activity"] == 6 ) {
		include ('comment.php');
	} else if ( $_GET["page_activity"] == 7 ) {
		include ('media.php');
	} else if ( $_GET["page_activity"] == 8 ) {
		include ('media-gallary.php');
	} else if ( $_GET["page_activity"] == 9 ) {
		include ('todo.php');
	}
	
} else {	 
	include("default.php");
 }
