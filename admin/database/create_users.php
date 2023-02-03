<?php
include 'db_connect.php';

$sql = "DROP TABLE tbl_users";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_users deleted successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table
$sql = "CREATE TABLE tbl_users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(300)  ,
username VARCHAR(300)  ,
email VARCHAR(300)  ,
password VARCHAR(30)  ,
option1 VARCHAR(300)  ,
option2 VARCHAR(300)  ,
is_active TINYINT(1),
log_date TIMESTAMP
) DEFAULT CHARACTER SET utf8   
 COLLATE utf8_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "Table user table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to insert data into employee table

$sql =  "INSERT INTO tbl_users (name,username,email,password,is_active)
VALUES ('Billal Hossain', 'admin', 'admin@admin.com','123',1),
('Abul', 'billal ', 'billal@billal.com','123',1);";


if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>