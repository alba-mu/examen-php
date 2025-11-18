<?php 
/**
 * File: topmenu.php
 * Author: Alba Muñoz
 * Date: 07/11/2025
 *
 * Description:
 * This file generates the top navigation bar for the application.
 * It adapts its links and options based on the user's login status and role.
 * Admin users see additional menu options, while logged-out users see 
 * Register and Login buttons. It uses Bootstrap 5 for styling and layout.
 */

    $isLogged = False;
    $isAdmin = False;

    // // Comprobar si hi ha sesió iniciada
    if(isset($_SESSION['role'])) {
        $isLogged = True;
        // Determinar si és admin
        if ($_SESSION['role'] === 'admin') {
            $isAdmin = True;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DAWBI-M07-Pt11</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-xxl navbar-dark bg-dark mb-4 ps-5 pe-5">
        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center me-5" href="https://www.proven.cat">
                <img src="images/ip_logo_sense_lletres.png" alt="Logo" class="logo-navbar me-2">
                <h6 class="display-6">ProvenSoft</h6>
            </a>

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

                    <?php if ($isAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_page === 'adminmenus.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                                href="adminmenus.php">
                                Admin Menus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_page === 'adminusers.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                                href="adminusers.php">
                                Admin Users</a>
                        </li>
                    <?php endif; ?>

                    <?php if ($isLogged): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_page === 'daymenu.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                                href="daymenu.php">
                                Day Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $current_page === 'viewmenus.php' ? 'active bg-secondary text-white rounded px-2' : '' ?>" 
                                href="viewmenus.php">
                                View Menus</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if (!$isLogged): ?>
                    <ul class="navbar-nav mb-2 mb-xxl-0">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-light btn-md" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-md" href="login.php">Login</a>
                        </li>
                    </ul>
                <?php endif; ?>
                
                <?php if ($isLogged): ?>
                    <ul class="navbar-nav mb-2 mb-xxl-0 ms-xxl-3 align-items-end">
                        <li class="nav-item d-flex align-items-center">
                            <span class="nav-link px-2">
                                <?= htmlspecialchars($_SESSION['name'] . " " . $_SESSION['surname']); ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-outline-light btn-md ms-2">Logout</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
