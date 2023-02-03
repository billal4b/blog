<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $tid = $_REQUEST["i"];
    $sta = 1;
    if ($stmt = $conn->prepare("UPDATE  tbl_comment SET  is_active = ? WHERE id = ?")) {
        $stmt->bind_param('dd', $bsta, $btid);
    } else {
        printf("Errormessage: %s\n", $conn->error);
    }
    // set parameters and execute
    $bsta = $sta;
    $btid = $tid;
    $stmt->execute();
    $stmt->close();
    $conn->close();

} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_REQUEST["id"];
    if($stmt = $conn->prepare("DELETE FROM  tbl_comment WHERE id = ?")){
        $stmt->bind_param('d',$deleteid);
    } else {
       printf("Errormessage: %s\n", $conn->error);
    }
    $deleteid = $id;
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "Delele Successfully.";

} else {

    //if($stmt = $conn->prepare("SELECT * FROM tbl_comment WHERE id > ? ")) 
    if ($stmt = $conn->prepare("SELECT c.id, c.post_id, c.comment, c.commenter_name, c.email, c.date_time, c.is_active, p.p_title
    FROM tbl_comment c
    INNER JOIN tbl_post p ON p.id = c.post_id
    WHERE c.id > ?")) {
        $stmt->bind_param('i', $comment_id);
    } else {
        printf("Errormessage: %s\n", $conn->error);
    }
    $comment_id = 0;
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
    $stmt->close();
    $conn->close();

}