<?php
include '../db_connect.php';

if (isset($_POST["submit"])) {

    $title = $_POST['title'];
    $type = $_POST['type'];
    $status = 1;

    if (is_array($_FILES)) {

        $file = $_FILES['upFile']['tmp_name'];
        $sourceProperties = getimagesize($file);
        //$fileNewName = time();
        $folderPath_img = "../uploads/images/";
        $folderPath_thm = "../uploads/thumbs/";
        $folderPath_vdo = "../uploads/videos/";
        $folderPath_pdf = "../uploads/pdf/";
        //$fileURL = $folderPath . basename($_FILES["image"]["name"]);
        $ext = pathinfo($_FILES['upFile']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];        

        // Format check
        if ($type == 1) {


            switch ($imageType) {


                case IMAGETYPE_PNG:
                    $imageResourceId = imagecreatefrompng($file);
                    $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                    $thum_img = $folderPath_thm . $title . "_thumb." . $ext;
                    imagepng($targetLayer, $thum_img);
                    break;


                case IMAGETYPE_GIF:
                    $imageResourceId = imagecreatefromgif($file);
                    $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                    $thum_img = $folderPath_thm . $title . "_thumb." . $ext;
                    imagegif($targetLayer, $thum_img);
                    break;


                case IMAGETYPE_JPEG:
                    $imageResourceId = imagecreatefromjpeg($file);
                    $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                    $thum_img = $folderPath_thm . $title . "_thumb." . $ext;
                    imagejpeg($targetLayer, $thum_img);
                    break;

                default:
                    echo "Invalid Image type.";
                    exit;
                    break;
            }

            // Upload file to server
            $root_img = $folderPath_img . $title . "." . $ext;

            if (move_uploaded_file($file, $root_img)) {

                if ($stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url, thum_img, is_active) VALUES (?,?,?,?,?) ")) {
                    $stmt->bind_param('dsssd', $mtype, $mtitle, $murl, $mhurl, $mstatus);
                } else {
                    printf("Errormessage: %s\n", $conn->error);
                }
                    // set parameters and execute
                $mtype = $type;
                $mtitle = $title;
                $murl = $root_img;
                $mhurl = $thum_img;
                $mstatus = $status;

                if ($stmt->execute()) {
                    echo " The file " . $title . " has been uploaded successfully. ";
                } else {
                    echo " File upload failed, please try again. ";
                }
            } else {
                echo " Sorry, there was an error uploading your file. ";
            }

        } elseif ($type == 2) {
            // Allow certain file formats
            $allowTypes = array('mp4', 'mov', 'wmv');
            if (in_array($ext, $allowTypes)) {
                // Upload file to server
                $vdo_url = $folderPath_vdo . $title . "." . $ext;
                if (move_uploaded_file($file, $vdo_url)) {
                    // Insert image file name into database
                    if ($stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url, thum_img, is_active) VALUES (?,?,?,?,?) ")) {
                        $stmt->bind_param('dsssd', $mtype, $mtitle, $murl, $mhurl, $mstatus);
                    } else {
                        printf("Errormessage: %s\n", $conn->error);
                    }
                    // set parameters and execute
                    $mtype = $type;
                    $mtitle = $title;
                    $murl = $vdo_url;
                    $mhurl = null;
                    $mstatus = $status;
                    if ($stmt->execute()) {
                        echo " The file " . $title . " has been uploaded successfully. ";
                    } else {
                        echo " File upload failed, please try again. ";
                    }

                } else {
                    echo " Sorry, there was an error uploading your file. ";
                }
            } else {
                echo ' Sorry, only mp4, mov & wmv files are allowed to upload. ';
            }

        } else {
            // Allow certain file formats
            $allowTypes = array('pdf', 'txt', 'docx', 'docm');
            if (in_array($ext, $allowTypes)) {
                // Upload file to server
                $pdf_url = $folderPath_pdf . $title . "." . $ext;
                if (move_uploaded_file($file, $pdf_url)) {
                    // Insert image file name into database

                    if ($stmt = $conn->prepare("INSERT INTO  tbl_media (file_type, file_title, file_url, thum_img,  is_active) VALUES (?,?,?,?,?) ")) {
                        $stmt->bind_param('dsssd', $mtype, $mtitle, $murl, $mhurl, $mstatus);
                    } else {
                        printf("Errormessage: %s\n", $conn->error);
                    }
                    // set parameters and execute
                    $mtype = $type;
                    $mtitle = $title;
                    $murl = $pdf_url;
                    $mhurl = null;
                    $mstatus = $status;
                    if ($stmt->execute()) {
                        echo " The file " . $title . " has been uploaded successfully. ";
                    } else {
                        echo " File upload failed, please try again. ";
                    }

                } else {
                    echo " Sorry, there was an error uploading your file. ";
                }
            } else {
                echo ' Sorry, only pdf, txt, docx & docm files are allowed to upload. ';
            }

        }
    }
}


function imageResize($imageResourceId, $width, $height)
{

    $targetWidth = 350;
    $targetHeight = 250;


    $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

    return $targetLayer;
}