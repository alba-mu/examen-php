<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 * Date: 18/11/2025
 *
 */

require_once './fn-php/fn-users.php';
require_once './fn-php/fn-avatars.php';

session_start();

$isLogged = false;
$msg_error = "";

// Comprovem si hi ha user loggejat
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
  $isLogged = true;
}

// Gestió del login
if (filter_has_var(INPUT_POST, "loginsubmit")) {

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  if ($username === '' || $password === '') {
    $msg_error = "Username and password are required.";
  } else {
    $userinfo = searchUser($username);

    if (count($userinfo) != 0) {  // usuari trobat
      if ($userinfo[1] === $password) { // password correcta
        // guardar dades en sessió
        $_SESSION['username'] = $userinfo[0];
        $_SESSION['password'] = $userinfo[1];
        $_SESSION['role'] = $userinfo[2];

        // Incrementar visites
        $visits = intval($userinfo[3]) + 1;
        $_SESSION['visits'] = $visits;

        // Actualitzar fitxer d'usuaris
        updateUser($userinfo[0], $userinfo[1], $userinfo[2], $visits);

        // Set cookie de login
        setcookie('loggedIn', true, time() + 3600, "/"); // expira 1 hora

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

$current_page = 'index.php';

// Generate filepaths for avatars
$avatars = listAvatars();
?>

<?php include_once "includes/topmenu.php"; ?>

<?php if (!$isLogged): ?>
  <main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="container" style="max-width: 400px;">
      <h2 class="text-center display-4 mb-4 fw-normal">Login Form</h2>
      <div class="card shadow mb-4">
        <div class="card-body">
          <?php if ($msg_error): ?>
            <div class="alert alert-danger pt-1 pb-1"><?php echo $msg_error; ?></div>
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

<?php if ($isLogged): ?>
  <div class="container text-center">
    <div class="row">
      <?php foreach ($avatars as $filename => $filepath) : ?>
        <div class="col-2 mb-4">
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
<?php endif; ?>

<?php include_once "includes/footer.php"; ?>