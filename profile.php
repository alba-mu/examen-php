<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 * Date: 18/11/2025
 */
session_start();
require_once './fn-php/fn-users.php';
require_once './fn-php/fn-visits.php';

$msg_error = "";

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (filter_has_var(INPUT_POST, "profilesubmit")) {
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if ($password === '') {
        $msg_error = "Password cannot be empty";
    } else {
        // Actualitzar password en sessió i fitxer
        $_SESSION['password'] = $password;
        updateUser($_SESSION['username'], $password, $_SESSION['role'], $_SESSION['visits']);
        $msg_error = "Password updated successfully";
    }
}

$current_page = 'profile.php';
?>

<?php include_once "includes/topmenu.php"; ?>

<main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container" style="max-width: 400px;">
        <h2 class="text-center display-4 mb-4 fw-normal">My Profile</h2>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php if ($msg_error): ?>
                    <div class="alert alert-info pt-1 pb-1"><?php echo $msg_error; ?></div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" disabled
                            value="<?php echo $_SESSION['username'] ?? ""; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter new password"
                            name="password" value="">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">Role:</label>
                        <input type="text" class="form-control" id="role" name="role" disabled
                            value="<?php echo $_SESSION['role'] ?? ""; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="visits" class="form-label fw-bold">Number of visits:</label>
                        <input type="text" class="form-control" id="visits" name="visits" disabled
                            value="<?php echo $_SESSION['visits'] ?? ""; ?>">
                    </div>

                    <button type="submit" name="profilesubmit" class="btn btn-dark w-100">Submit</button>
                    <p class="mt-2 text-center"><a href="logout.php">Logout</a></p>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include_once "includes/footer.php"; ?>