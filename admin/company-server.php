<?php

include '../db_connect.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST') {    

    if (isset($_POST['save'])) {
        $nam = $_POST["cname"];
	    $ctg = $_POST["category"];
	    $des = $_POST["description"];
	    $loc = $_POST["location"];
        $con = $_POST["contact"];
        $sta = $_POST["status"];

         // prepare and bind
        if( $stmt = $conn->prepare("INSERT INTO  tbl_company (name,category,description,location,contact,is_active) VALUES (?,?,?,?,?,?) ")) {
            $stmt->bind_param('ssssss', $inam, $ictg, $ides, $iloc, $icon, $ista);
        } else {
            printf("Errormessage: %s\n", $conn->error);
        }

        // set parameters and execute
        $inam = $nam;
        $ictg = $ctg;
        $ides = $des;
        $iloc = $loc;
        $icon = $con;
        $ista = $sta;
        //$stmt->execute();

        if($stmt->execute()){
            echo "Successfully Inserted";;
        } else {
            echo "Failed to add data!";
        }
    }
    $stmt->close();
    $conn->close();

} else if ( $_SERVER['REQUEST_METHOD'] == 'GET'){

    $nam = $_REQUEST["na"];
    $ctg = $_REQUEST["ct"];
    $des = $_REQUEST["ds"];
    $loc = $_REQUEST["lo"];
    $con = $_REQUEST["cn"];
    $sta = $_REQUEST["st"];
    $cid = $_REQUEST["id"];
    
    if($stmt = $conn->prepare("UPDATE  tbl_company SET name = ?,category = ?,description = ?,location = ?,contact = ?,is_active = ? WHERE id = ?")){
        $stmt->bind_param('sssssdd',$cnam, $cctg,$cdes,$cloc,$ccon,$csta,$ccid);
    } else {
    //printf("Errormessage: %s\n", $conn->error);
    }

    // set parameters and execute
    $cnam = $nam;
    $cctg = $ctg;
    $cdes = $des;
    $cloc = $loc;
    $ccon = $con;
    $csta = $sta;
    $ccid = $cid;
    $stmt->execute();

    $stmt->close();
    $conn->close();
    echo "Information updated.";

} else {

    $id = $_REQUEST["id"];

    if($stmt = $conn->prepare("DELETE FROM  tbl_company WHERE id = ?")){
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

?> 