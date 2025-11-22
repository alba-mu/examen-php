<?php
/**
 * File: avatarManagement.php
 * Author: Alba Muñoz
 *
 * Description: 
 * This page shows a form for file upload and an avatar gallery.
 * The file upload form only admits png and jpeg files and upon successful upload, the new avatar is shown in the gallery.
 * Error or success message is recovered from session to show to user.
 * The avatar gallery consists of each avatar photo with its name and a download button. 
 * Access to the page is verified by user's role. If user doesn't have permission, it's redirected to index.php
 */
session_start();
require_once './fn-php/fn-users.php';
require_once './fn-php/fn-roles.php';
require_once './fn-php/fn-avatars.php';

// Verify user's valid role to access page
if (!isGranted($_SESSION['role'], 'avatarManagement')) {
    header("Location: index.php");
    exit();
}

// Recover upload message from session
$alert = null;
if (isset($_SESSION['upload_message'])) {
    $alert = $_SESSION['upload_message'];
    unset($_SESSION['upload_message']);
}

// Llistar avatars
$avatars = listAvatars();

$current_page = 'avatarManagement.php';
include_once "includes/topmenu.php";
?>

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
                            <div class="alert alert-danger py-2">
                                <?= htmlspecialchars($alert['error']) ?>
                            </div>
                        <?php elseif (isset($alert['success'])): ?>
                            <div class="alert alert-success py-2">
                                <?= htmlspecialchars($alert['success']) ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <form name="form_image" action="fn-php/upload.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" name="filename" accept="image/png, image/jpeg" />
                            <input class="btn btn-dark text-white" type="submit" value="upload" name="submit_image">
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($avatars as $filename => $filepath): ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                    <div class="card border-1 text-dark p-3 rounded-4 text-center">
                        <img class="rounded-circle img-thumbnail mx-auto img-fluid" src="<?= $filepath ?>"
                            alt="<?= $filename ?>">
                        <p class="mt-2"><?= $filename ?></p>
                        <a href="./fn-php/download.php?file=<?= $filename ?>" class="btn btn-outline-dark">Download</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<?php include_once "includes/footer.php"; ?>