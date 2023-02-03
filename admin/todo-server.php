<?php
include '../db_connect.php';



    if ($stmt = $conn->prepare("SELECT * FROM tbl_todos WHERE id > ? ")) {
        $stmt->bind_param('i', $todo_id);
      } else {
        printf("Errormessage: %s\n", $conn->error);
      }
      $todo_id = 0;
      $stmt->execute();
      $result = $stmt->get_result();
      $stmt->close();
      $conn->close();



