<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 * Date: 18/11/2025
 *
 */
session_start();
require_once './fn-php/fn-users.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'advanced') {
    header("Location: index.php");
    exit();
}

$current_page = 'avatarManagement.php';
?>

<?php include_once "includes/topmenu.php"; ?>

<main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container" style="max-width: 400px;">
        <h2 class="text-center display-4 mb-4 fw-normal">Avatar Management</h2>
        <p class="text-center text-muted">Page under construction</p>
    </div>
</main>

<?php include_once "includes/footer.php"; ?>