<?php
/**
 * File: download.php
 * Author: Alba Muñoz
 * Date: 21/11/2025
 *
 * Description:
 * Safely serves avatar image files for download.
 * Validates the requested filename and forces the browser to download it.
 */

$avatarDir = '../avatars/';

// 1. Comprovar que tenim el paràmetre 'file'
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$filename = basename($_GET['file']);

// 2. Construir la ruta real
$filepath = $avatarDir . $filename;

// 3. Comprovar que el fitxer existeix i és llegible
if (!file_exists($filepath) || !is_file($filepath)) {
    die("File not found.");
}

// 4. Detectar tipus MIME
$mime = mime_content_type($filepath);

// Només permetre descarregar imatges
$allowed = ['image/jpeg', 'image/png'];
if (!in_array($mime, $allowed)) {
    die("Invalid file type.");
}

// 5. Enviar headers per forçar la descàrrega
header("Content-Type: $mime");
header('Content-Disposition: attachment; filename="' . $filename . '"');
header("Content-Length: " . filesize($filepath));
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

// 6. Enviar el fitxer
readfile($filepath);
exit;