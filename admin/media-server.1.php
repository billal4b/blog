<?php

include '../db_connect.php';
include_once 'class/imaging.php';

if(isset($_POST['submitFile'])) {

    $title  = $_POST['title'];
    $type   = $_POST['type'];
    $status = 1;

	for ( $i=0; $i<count($_FILES["uploadFile"]["name"]); $i++) {

        $uploadfile = $_FILES["uploadFile"]["tmp_name"][$i];        
        $folderDir = "../uploads/";
        $filename  = $_FILES["uploadFile"]["name"][$i];       

        $fileURL   = $folderDir.basename($_FILES["uploadFile"]["name"][$i]);       
        $fileType  = pathinfo($fileURL,PATHINFO_EXTENSION);        
       
        // Format check
        if ( $type == 1 ) {

            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif');

            if (in_array( $fileType, $allowTypes )) {

               
                // Upload file to server
               if( move_uploaded_file($_FILES["uploadFile"]["tmp_name"][$i], "$folderDir".$_FILES["uploadFile"]["name"][$i])) {

                    if ( $stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url, is_active) VALUES (?,?,?,?) ") ) {
                        $stmt->bind_param('dssd', $mtype, $mtitle, $murl, $mstatus);
                    } else {
                        printf("Errormessage: %s\n", $conn->error);
                    }
                    // set parameters and execute
                    $mtype   = $type;
                    $mtitle  = $title;
                    $murl    = $fileURL;
                    $mstatus = $status;
                    
                    if( $stmt->execute()) {
                        echo "The file " .$title. " has been uploaded successfully.";
                    } else {
                        echo "File upload failed, please try again.";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
            }
        } elseif ( $type == 2 ) {      
            echo "ok 2"; 
        } else { 
            echo " ok 3";
        } 
                
	}
	exit();
}

/*
$statusMsg = '';
//$successMsg = '';
include '../db_connect.php';

// File upload path
$targetDir = "../assets/uploads/";
$fileName  = $targetDir.basename($_FILES["file"]["name"]);
$fileType  = pathinfo($fileName,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]) && !empty($_POST["title"])) {
    
    $title = $_POST['title'];
    $type  = $_POST['type'];

    // Format check
    if ( $type == 1 ) {
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg');

        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if ( move_uploaded_file( $_FILES["file"]["tmp_name"], $fileName) ){
                // Insert image file name into database
               
                if ( $stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url) VALUES (?,?,?) ") ) {
                    $stmt->bind_param('dss', $mtype,$mtitle,$murl);
                } else {
                    printf("Errormessage: %s\n", $conn->error);
                }
                // set parameters and execute
                $mtype  = $type;
                $mtitle = $title;
                $murl   = $fileName;
                if( $stmt->execute()) {
                     $statusMsg = "The file ".$title. " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }

            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }  
        
    } elseif ( $type == 2 ) {

        // Allow certain file formats
        $allowTypes = array('mp4','mov','wmv');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if ( move_uploaded_file( $_FILES["file"]["tmp_name"], $fileName) ){
                // Insert image file name into database
                if ( $stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url) VALUES (?,?,?) ") ) {
                    $stmt->bind_param('dss', $mtype,$mtitle,$murl);
                } else {
                    printf("Errormessage: %s\n", $conn->error);
                }
                // set parameters and execute
                $mtype  = $type;
                $mtitle = $title;
                $murl   = $fileName;
                if( $stmt->execute()) {
                     $statusMsg = "The file ".$title. " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }

            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only mp4, mov & wmv files are allowed to upload.';
        }

    } else {

        // Allow certain file formats
        $allowTypes = array('pdf','txt','docx','docm');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if ( move_uploaded_file( $_FILES["file"]["tmp_name"], $fileName) ){
                // Insert image file name into database
                
                if ( $stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url) VALUES (?,?,?) ") ) {
                    $stmt->bind_param('dss', $mtype,$mtitle,$murl);
                } else {
                    printf("Errormessage: %s\n", $conn->error);
                }
                // set parameters and execute
                $mtype  = $type;
                $mtitle = $title;
                $murl   = $fileName;
                if( $stmt->execute()) {
                     $statusMsg = "The file ".$title. " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }

            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only pdf, txt, docx & docm files are allowed to upload.';
        }
    }    



} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message

    echo $statusMsg;
*/