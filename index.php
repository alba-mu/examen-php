<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 * Date: 18/11/2025
 *
 */

require_once './fn-php/fn-users.php';

if (isset($_COOKIE['loggedIn'])){
    $isLogged = True;
}

$msg_error = "";

if (filter_has_var(INPUT_POST, "loginsubmit")) {

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  // search user
  $userinfo = searchUser($username);
  
  if ($username === '' || $password === '') {
    $msg_error = "Username and password are required.";
  } else if (count($userinfo) != 0) {  // user found
    // Check password
    if ($userinfo[1] === $password) {
      // start session
      session_start();
      // save data in session
      $_SESSION['username'] = $userinfo[0];
      $_SESSION['password'] = $userinfo[1];
      $_SESSION['role'] = $userinfo[2];
      //Actualitzar visites
      $_SESSION['visits'] = $userinfo[3]++;

      setcookie('loggedIn', True);
    
    } else {  // incorrect password
      $msg_error = "Incorrect password";
    }
  } else {  // user not found
    $msg_error = "User not found";
  }
} else {
    $username =  '';
    $password =  '';
}


$current_page = 'index.php';
?>

<?php include_once "includes/topmenu.php"; ?>

<?php if (!$isLogged) : ?>
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
                value="<?php echo $password ?? ""; ?>">
            </div>

            <button type="submit" name="loginsubmit" class="btn btn-dark w-100">Submit</button>

            </form>

        </div>
        </div>
        
    </div>
    </main>
<?php endif; ?>
<?php if($isLogged): ?>
<div>
    <p>You are logged in</p>
</div>
<?php endif; ?>

<?php include_once "includes/footer.php"; ?>

</body>
</html>