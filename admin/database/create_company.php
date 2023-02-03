<?php
include 'db_connect.php';

$sql = "DROP TABLE tbl_company";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_company deleted successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_company (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(300),
category VARCHAR(300),
description VARCHAR(300),
location VARCHAR(300),
contact VARCHAR(300),
is_active TINYINT(1),
option1 VARCHAR(300),
option2 VARCHAR(300),
create_date TIMESTAMP
) DEFAULT CHARACTER SET utf8   
 COLLATE utf8_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "Table user table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to insert data into employee table

$sql =  "INSERT INTO tbl_company (name,category,description,location,contact,is_active)
VALUES ('bGlobal', 'IT', 'All your programming and digital marketing needs solved','Banani,Dhaka','service@bglobal.com',1),
       ('MaxPro it solutions', 'IT', 'Software and Web Development', 'Segun bagicha,Dhaka', 'service@maxpro.com', 1);";

 
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>