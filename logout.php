<?php
/**
 * File: logout.php
 * Author: Alba Muñoz
 *
 * Description:
 * This file handles user logout.
 * If a session exists, it destroys it and displays a confirmation message with button to redirect to index page.
 * If no session exists, it redirects user to index page.
 */
session_start();

$loggedOut = false;

if (isset($_SESSION['role'])) {
    // Destroy and clean session
    $_SESSION = [];
    session_destroy();
    // Delete 'loggedIn' cookie
    setcookie('loggedIn', '', time() - 3600, "/");
    $loggedOut = true;
} else {
    header("Location: index.php");
    exit();
}
?>

<?php if ($loggedOut): ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logout</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body class="bg-dark text-light d-flex flex-column min-vh-100">
        <main class="flex-grow-1 d-flex justify-content-center align-items-center">
            <div class="card text-center p-4 shadow-lg" style="max-width: 400px;">
                <div class="card-body">
                    <h2 class="card-title mb-3">You have logged out successfully</h2>
                    <p class="card-text fs-4 mb-4">See you soon!</p>
                    <a href="index.php" class="btn btn-dark text-white w-100">Return to homepage</a>
                </div>
            </div>
        </main>
    </body>

    </html>
<?php endif; ?>