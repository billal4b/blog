<?php
session_start();
include 'db_connect.php';

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);
    $password = $pass;   
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email=?");
    $stmt->bind_param("d", $email);
    $stmt->execute();   
    $stmt->bind_result($id,$name,$usermane,$myemail,$mypass,$col1,$col2,$col3,$col4);
    $stmt->fetch();     
    if( $mypass==$password && $myemail==$email ) {
        echo "ok";
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
    } else{
        echo "Email and Password does not match!";
    }
}

$stmt->close();
$conn->close();

?>
