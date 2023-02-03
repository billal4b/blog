<?php
include 'db_connect.php';

$sql = "DROP TABLE tbl_category";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_category deleted successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_category (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(300),
    description VARCHAR(300),
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

$sql =  "INSERT INTO tbl_category (title,description,is_active)
VALUES ('IT', 'All your programming and digital marketing needs solved',1),
       ('General', 'History of human',1);";

 
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();


   