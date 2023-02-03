<?php

include '../../db_connect.php';

$sql = "DROP TABLE tbl_todos";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_todos deleted successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_todos (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
site_url VARCHAR(300),
site_name VARCHAR(45),
site_group VARCHAR(45),
option2 VARCHAR(45),
is_active TINYINT(1),
log_date TIMESTAMP
) DEFAULT CHARACTER SET utf8   
 COLLATE utf8_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "Table to do list table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to insert data into table

$sql =  "INSERT INTO tbl_todos (site_url,site_name,site_group,is_active)
VALUES ('https://w3schools.com', 'w3schools', 'php', 1);";


if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>