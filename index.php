<?php
/**
 * File: index.php
 * Author: Alba Muñoz
 * Date: 07/11/2025
 *
 * Description:
 * This is the homepage of ProvenSoft Restaurant. It displays a welcome
 * message, a brief description of the restaurant, and two main call-to-action
 * buttons: "Check today's menu" and "View the full menu". 
 * The buttons redirect to the corresponding pages or to the login page 
 * if the user is not logged in. 
 */

session_start();
$current_page = 'index.php';
?>

<?php include_once "includes/topmenu.php"; ?>

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
            <label for="username" class="form-label fw-bold">Email:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
              value="<?php echo $username ?? ""; ?>">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"
              value="<?php echo $password ?? ""; ?>">
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>

          <button type="submit" name="loginsubmit" class="btn btn-dark w-100">Submit</button>

          <p class="text-center mt-3 mb-0">Don't have an account? <a href="register.php">Register</a> </p>

        </form>

      </div>
    </div>
    
  </div>
</main>


<?php include_once "includes/footer.php"; ?>

</body>
</html>