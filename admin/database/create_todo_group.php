<?php

include '../../db_connect.php';

$sql = "DROP TABLE tbl_todo_groups";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_todo_groups deleted successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_todo_groups (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
group_name VARCHAR(45),
option2 VARCHAR(45),
is_active TINYINT(1),
log_date TIMESTAMP
) DEFAULT CHARACTER SET utf8   
 COLLATE utf8_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "Table tbl_todo_groups table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to insert data into table

$sql =  "INSERT INTO tbl_todo_groups (group_name,is_active)
VALUES ('php', 1);";


if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>
