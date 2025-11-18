<?php 
/**
 * File: topmenu.php
 * Author: Alba Muñoz
 * Date: 18/11/2025
 *
 * Description:
 * This file generates the top navigation bar for the application.
 * It adapts its links and options based on the user's login status and role.
 */

    $isLogged = False;
    $isAdvanced = False;

    // Comprobar si hi ha sesió iniciada
    if(isset($_SESSION['role'])) {
        $isLogged = True;
        // Determinar si és advanced
        if ($_SESSION['role'] === 'advanced') {
            $isAdvanced = True;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DAWBI-M07-Examen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-xxl navbar-dark bg-dark mb-4 ps-5 pe-5">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto ms-5 mb-2 mb-lg-0 gap-3 gap-xxl-4">

                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'index.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                            href="index.php">
                            Home</a>
                    </li>

                    <?php if ($isLogged): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_page === 'profile.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                                href="profile.php">
                                Profile page</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ($isAdvanced): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_page === 'avatarManagement.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                                href="avatarManagement.php">
                                Avatar Management</a>
                        </li>
                    <?php endif; ?>

                    
                </ul>
                
                <?php if ($isLogged): ?>
                    <ul class="navbar-nav mb-2 mb-xxl-0 ms-xxl-3 align-items-end">
                        <li class="nav-item d-flex align-items-center">
                            <span class="nav-link px-2">
                                <?= htmlspecialchars($_SESSION['username'] ?? ''); ?>
                            </span>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
