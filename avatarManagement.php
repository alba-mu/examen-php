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
        <form name="form_image" action="fn-php/upload.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Image</legend>
                <input type="file" name="filename" accept="image/png, image/jpeg"/>
            </fieldset>
            <fieldset>
                <legend>Width and Height</legend>
                <input type="number" name="width" min="0" max="900" value="450"/>
                <input type="number" name="height" min="0" max="650" value="325"/>
            </fieldset>
            <p><input type="submit" value="upload" name="submit_image">
                <input type="reset" value="reset" name="reset_image">
            </p>
        </form>
    </div>


    <div class="container text-center">
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