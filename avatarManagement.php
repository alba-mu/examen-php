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

// Recuperar missatge de sessió
$alert = null;
if (isset($_SESSION['upload_message'])) {
    $alert = $_SESSION['upload_message'];
    unset($_SESSION['upload_message']);
}

// Llistar avatars
$avatars = listAvatars();
?>

<?php include_once "includes/topmenu.php"; ?>

<main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container text-center">
        <div class="row">
            <div class="card mb-4 p-0 border border-2 border-dark"> 
                <div class="card-header bg-dark-subtle pb-0 border-bottom border-2 border-dark">
                    <h3>Upload new avatar to server</h3>
                </div>    
                <div class="card-body">

                    <?php if ($alert): ?>
                        <?php if (isset($alert['error'])): ?>
                            <div class="alert alert-danger p-2">
                                <?= htmlspecialchars($alert['error']) ?>
                            </div>
                        <?php elseif (isset($alert['success'])): ?>
                            <div class="alert alert-success p-2">
                                <?= htmlspecialchars($alert['success']) ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <form name="form_image" action="fn-php/upload.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" name="filename" accept="image/png, image/jpeg"/>
                            <input class="btn btn-dark text-white" type="submit" value="upload" name="submit_image">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($avatars as $filename => $filepath) : ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                    <div class="card border-1 text-dark p-3 rounded-4 text-center">
                        <img class="rounded-circle img-thumbnail mx-auto img-fluid" 
                            src="<?=$filepath?>" 
                            alt="<?=$filename?>">
                        <p class="mt-2"><?=$filename?></p>
                        <a href="./fn-php/download.php?file=<?=$filename?>" class="btn btn-outline-dark">Download</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
  </div>
</main>

<?php include_once "includes/footer.php"; ?>