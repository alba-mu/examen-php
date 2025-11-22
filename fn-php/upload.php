<?php
session_start();
define("PATH_TO_UPLOADED_FILES", "../avatars/");

$message = [];

if (isset($_POST['submit_image'])) {

    if (!isset($_FILES['filename']) || $_FILES['filename']['error'] !== 0) {
        $message['error'] = "Error uploading file.";
    } else {

        $tmp = $_FILES['filename']['tmp_name'];
        $originalName = basename($_FILES['filename']['name']);
        $destination = PATH_TO_UPLOADED_FILES . $originalName;

        // Validació bàsica d'imatge
        $mime = mime_content_type($tmp);
        $allowed = ['image/png', 'image/jpeg'];

        if (!in_array($mime, $allowed)) {
            $message['error'] = "Only JPG and PNG images allowed.";
        } else {

            if (move_uploaded_file($tmp, $destination)) {
                $message['success'] = "File $originalName uploaded successfully.";
            } else {
                $message['error'] = "File NOT uploaded.";
            }
        }
    }
}

// Guardar missatges a la sessió
$_SESSION['upload_message'] = $message;

// tornar a avatarManagement.php
header("Location: ../avatarManagement.php");
exit();