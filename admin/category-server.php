<?php

include '../db_connect.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST') {    

    if (isset($_POST['save'])) {
        $tit = $_POST["title"];
	    $des = $_POST["description"];
        $sta = $_POST["status"];
         // prepare and bind
        if( $stmt = $conn->prepare("INSERT INTO  tbl_category (title,description,is_active) VALUES (?,?,?) ")) {
            $stmt->bind_param('ssd', $btit,$bdes,$bsta);
        } else {
            printf("Errormessage: %s\n", $conn->error);
        }
        // set parameters and execute
        $btit = $tit;
        $bdes = $des;
        $bsta = $sta;
        //$stmt->execute();
        if($stmt->execute()){
            echo "Successfully Inserted";
        } else {
            echo "Failed to add data!";
        }
    }
    $stmt->close();
    $conn->close();

} else if ( $_SERVER['REQUEST_METHOD'] == 'GET') {

    $tit = $_REQUEST["t"];
    $des = $_REQUEST["d"];
    $sta = $_REQUEST["s"];
    $tid = $_REQUEST["i"];    
    if($stmt = $conn->prepare("UPDATE  tbl_category SET title = ?, description = ?, is_active = ? WHERE id = ?")){
        $stmt->bind_param('ssdd',$btit,$bdes,$bsta,$btid);
    } else {
    //printf("Errormessage: %s\n", $conn->error);
    }
    // set parameters and execute
    $btit = $tit;
    $bdes = $des;
    $bsta = $sta;  
    $btid = $tid;
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "Information updated.";

} else {

    $id = $_REQUEST["id"];
    if($stmt = $conn->prepare("DELETE FROM  tbl_category WHERE id = ?")){
        $stmt->bind_param('d',$deleteid);
    } else {
    //printf("Errormessage: %s\n", $conn->error);
    }
    $deleteid = $id;
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "Delele Successfully.";

}

