<?php
/**
 * File: download.php
 * Author: Alba Muñoz
 *
 * Description:
 * Safely serves avatar image files for download.
 * Validates the requested filename and forces the browser to download it.
 */

$avatarDir = '../avatars/';

// Verify parameter 'file' exists
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$filename = basename($_GET['file']);

// Generate filepath
$filepath = $avatarDir . $filename;

// Verify file exists and is readable
if (!file_exists($filepath) || !is_file($filepath)) {
    die("File not found.");
}

// Detect MIME type
$mime = mime_content_type($filepath);

// Only allow download of images
$allowed = ['image/jpeg', 'image/png'];
if (!in_array($mime, $allowed)) {
    die("Invalid file type.");
}

// Send headers to force download
header("Content-Type: $mime");
header('Content-Disposition: attachment; filename="' . $filename . '"');
header("Content-Length: " . filesize($filepath));
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

// Send file
readfile($filepath);
exit;