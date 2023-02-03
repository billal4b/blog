<?php

include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tgn = $_REQUEST["gn"];
    
    if ($tgn != null) {
        $sta = 1;
        if ($stmt = $conn->prepare("INSERT INTO  tbl_todo_groups ( group_name, is_active ) VALUES (?,?)")) {
            $stmt->bind_param('sd', $tdgn, $tsta);
        } else {
            printf("Errormessage: %s\n", $conn->error);
        }
        // set parameters and execute 
        $tdgn = $tgn;
        $tsta = $sta;
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_REQUEST["id"];
    if($stmt = $conn->prepare("DELETE FROM  tbl_todo_groups WHERE id = ?")){
        $stmt->bind_param('d', $deleteid );
    } else {
    //printf("Errormessage: %s\n", $conn->error);
    }
    $deleteid = $id;
    $stmt->execute();
    $stmt->close();
    $conn->close();

} else {

    if ($stmt = $conn->prepare("SELECT * FROM tbl_todo_groups WHERE id > ? ")) {
        $stmt->bind_param('i', $todo_grp_id);
    } else {
        printf("Errormessage: %s\n", $conn->error);
    }
    $todo_grp_id = 0;
    $stmt->execute();
    $groups = $stmt->get_result();
    $stmt->close();
    $conn->close();    

}