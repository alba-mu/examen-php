<?php
/**
 * File: upload.php
 * Author: Alba Muñoz
 * 
 * Description:
 * This file manages the upload of new avatar files to server.
 * Messages of error or success are recorded and save to session.
 * Once file is uploaded and moved successfuly or an error has occured, 
 * page is redirected to avatarManagement.php, where user recives feedback 
 * on status of the upload process.
 * If process is successfull, new avatar is saved into avatars/ directory
 */
session_start();

// Define path to upload files
define("PATH_TO_UPLOADED_FILES", "../avatars/");

$message = [];

// Manage upload form
if (isset($_POST['submit_image'])) {

    if (!isset($_FILES['filename']) || $_FILES['filename']['error'] !== 0) {
        $message['error'] = "Error uploading file.";
    } else {

        $tmp = $_FILES['filename']['tmp_name'];
        $originalName = basename($_FILES['filename']['name']);
        $destination = PATH_TO_UPLOADED_FILES . $originalName;

        // Validate file type
        $mime = mime_content_type($tmp);
        $allowed = ['image/png', 'image/jpeg'];

        if (!in_array($mime, $allowed)) {
            $message['error'] = "Only JPG and PNG images allowed.";
        } else {
            // Valid type -> move file to destination
            if (move_uploaded_file($tmp, $destination)) {
                $message['success'] = "File $originalName uploaded successfully.";
            } else {
                $message['error'] = "File NOT uploaded.";
            }
        }
    }
}

// Save message on session
$_SESSION['upload_message'] = $message;

// Redirect to avatarManagement.php
header("Location: ../avatarManagement.php");
exit();