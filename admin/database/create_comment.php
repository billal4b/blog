<?php
include '../../db_connect.php';

$sql = "DROP TABLE tbl_comment";
if ($conn->query($sql) === true) {
    echo "Table tbl_comment deleted successfully";
    echo "<br/>";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_comment (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
post_id INT(10),
comment VARCHAR(300),
commenter_name VARCHAR(300),
email VARCHAR(300),
date_time DATE,
is_active TINYINT(1),
option1 VARCHAR(300),
option2 VARCHAR(300),
create_date TIMESTAMP
) DEFAULT CHARACTER SET utf8   
 COLLATE utf8_general_ci";

if ($conn->query($sql) === true) {
    echo "Table user table created successfully";
    echo "<br/>";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to insert data into employee table

$sql = "INSERT INTO tbl_comment (post_id,comment,commenter_name,email,date_time,is_active) VALUES 
(2, 'All your programming and digital marketing needs solved','hossain','hossain@gmail.com','2018-05-20',0),
(3, 'All your programming', 'billal','billal4b@gmail.com','2018-05-20',0),
(4, 'programming', 'billal','billal4b@gmail.com','2018-05-20',0),
(5, 'All your', 'billal','billal4b@gmail.com','2018-05-20',0);";


if ($conn->query($sql) === true) {
    echo "Data inserted successfully";
    echo "<br/>";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>