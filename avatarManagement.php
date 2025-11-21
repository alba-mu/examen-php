<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 * Date: 18/11/2025
 *
 */
session_start();
require_once './fn-php/fn-users.php';
require_once './fn-php/fn-avatars.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'advanced') {
    header("Location: index.php");
    exit();
}

$current_page = 'avatarManagement.php';

// Generate filepaths for avatars
$avatars = listAvatars();
?>

<?php include_once "includes/topmenu.php"; ?>

<main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container text-center">
        <div class="row">
            <?php foreach ($avatars as $filename => $filepath) : ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                    <div class="card border-1 text-dark p-3 rounded-4 text-center">
                        <img class="rounded-circle img-thumbnail mx-auto img-fluid" 
                            src="<?=$filepath?>" 
                            alt="<?=$filename?>">
                        <p class="mt-2"><?=$filename?></p>
                        <a href="download.php?file=<?=$filename?>" class="btn btn-outline-dark">Download</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
  </div>
</main>

<?php include_once "includes/footer.php"; ?>