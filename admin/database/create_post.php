<?php
include 'db_connect.php';

$sql = "DROP TABLE tbl_post";
if ($conn->query($sql) === TRUE) {
    echo "Table tbl_post deleted successfully"; echo "<br/>";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table

$sql = "CREATE TABLE tbl_post (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
p_title VARCHAR(300),
content VARCHAR(3000),
image VARCHAR(300),
thum_img VARCHAR(300),
category_id INT(10),
releted_post_id INT(10),
date_time DATE,
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

$sql =  "INSERT INTO tbl_post (p_title,content,image,thum_img,category_id,releted_post_id,date_time,is_active)
VALUES ('bGlobal', 'All your programming and digital marketing needs solved', '/image.jpg', '/image.jpg',1 , 1,'2018-05-20',1),
('MaxPro', 'All your programming and digital marketing needs solved', '/image.jpg', '/image.jpg',1 , 1,'2018-05-20',1);";

 
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully"; echo "<br/>";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();



?>