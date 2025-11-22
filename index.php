<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 *
 * Description: 
 * This file validates if user is logged in or not.
 * If user is NOT logged in, a login form is shown for user identification.
 * If an error occures while logging in, it is shown so user knows what happened.
 * If user logges in correctly or was already logged in, an avatar gallery is shown.
 * The avatar gallery consists of each avatar photo with its name and a download button.
 */

require_once './fn-php/fn-users.php';
require_once './fn-php/fn-avatars.php';

session_start();

$isLogged = false;
$msg_error = "";

// Verify if user is logged in
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
  $isLogged = true;
}

// Manage login form
if (filter_has_var(INPUT_POST, "loginsubmit")) {

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  if ($username === '' || $password === '') {
    $msg_error = "Username and password are required.";
  } else {
    // Verify if user exists
    $userinfo = searchUser($username);

    if (count($userinfo) != 0) {  // user exists
      if ($userinfo[1] === $password) { // valid password
        // save user info in session
        $_SESSION['username'] = $userinfo[0];
        $_SESSION['password'] = $userinfo[1];
        $_SESSION['role'] = $userinfo[2];

        // Update user's visits value in session
        $visits = intval($userinfo[3]) + 1;
        $_SESSION['visits'] = $visits;

        // Update users.txt file
        updateUser($userinfo[0], $userinfo[1], $userinfo[2], $visits);

        // Set cookie to loggedIn
        setcookie('loggedIn', true, time() + 3600, "/"); // expires in 1 hour

        $isLogged = true;

      } else {
        $msg_error = "Incorrect password";
      }
    } else {
      $msg_error = "User not found";
    }
  }
} else {
  $username = '';
  $password = '';
}

// List avatars
$avatars = listAvatars();

$current_page = 'index.php';
include_once "includes/topmenu.php";
?>

<?php if (!$isLogged): //Show login form ?>
  <main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container" style="max-width: 400px;">
      <h2 class="text-center display-4 mb-4 fw-normal">Login Form</h2>
      <div class="card shadow mb-4">
        <div class="card-body">

          <?php if ($msg_error): ?>
            <div class="alert alert-danger py-2"><?php echo $msg_error; ?></div>
          <?php endif; ?>

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="mb-3">
              <label for="username" class="form-label fw-bold">Username:</label>
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
                value="<?php echo $username ?? ""; ?>">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label fw-bold">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"
                value="">
            </div>
            <button type="submit" name="loginsubmit" class="btn btn-dark w-100">Submit</button>
          </form>

        </div>
      </div>
    </div>
  </main>
<?php endif; ?>

<?php if ($isLogged): //Show avatar gallery ?>
  <main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container text-center">
      <div class="row">

        <?php foreach ($avatars as $filename => $filepath): ?>
          <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
            <div class="card border-1 text-dark p-3 rounded-4 text-center">
              <img class="rounded-circle img-thumbnail mx-auto img-fluid" src="<?= $filepath ?>" alt="<?= $filename ?>">
              <p class="mt-2"><?= $filename ?></p>
              <a href="./fn-php/download.php?file=<?= $filename ?>" class="btn btn-outline-dark">Download</a>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </main>
<?php endif; ?>

<?php include_once "includes/footer.php"; ?>