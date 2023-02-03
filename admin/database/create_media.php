<?php
include 'db_connect.php';

$sql = "DROP TABLE tbl_media";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_media deleted successfully"; echo "<br/>";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_media (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
file_type int(10),
file_title VARCHAR(300),
file_url VARCHAR(300),
thum_img VARCHAR(300),
is_active TINYINT(1),
option1 VARCHAR(300),
option2 VARCHAR(300),
create_date TIMESTAMP
) DEFAULT CHARACTER SET utf8   
 COLLATE utf8_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "Table user table created successfully"; echo "<br/>";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to insert data into employee table

$sql =  "INSERT INTO tbl_media (file_title,file_type,file_url,thum_img,is_active)
VALUES ('bGlobal',1, '/image.jpg', '/image.jpg',1),
       ('MaxPro',2, '/image.jpg', '/image.jpg', 1);";

 
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully"; echo "<br/>";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>