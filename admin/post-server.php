<?php
   include '../db_connect.php';

if (isset($_POST['save'])) {

    $tit = $_POST['title'];
    $ctg = $_POST['category'];
    $cnt = $_POST['content'];
    $dat = $_POST['date_time'];
    $sta = $_POST['status'];
    
    // prepare and bind
    if( $stmt = $conn->prepare("INSERT INTO  tbl_post (p_title,category_id,content,date_time,is_active) VALUES (?,?,?,?,?) ")) {
        $stmt->bind_param('ssssd', $btit,$bctg,$bcnt,$bdat,$bsta);
    } else {
        printf("Errormessage: %s\n", $conn->error);
    }
    // set parameters and execute
    $btit = $tit;
    $bctg = $ctg;
    $bcnt = $cnt;
    $bdat = $dat;
    $bsta = $sta;      

    if($stmt->execute()){
        echo "Successfully Inserted";;
    } else {
        echo "Failed to add data!";
    }
}
$stmt->close();
$conn->close();

