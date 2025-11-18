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
require_once './fn-php/fn-users.php';
$current_page = 'profile.php';
?>

<?php include_once "includes/topmenu.php"; ?>


<main class="flex-grow-1 d-flex justify-content-center align-items-center">
<div class="container" style="max-width: 400px;">

    
    
</div>
</main>

<?php include_once "includes/footer.php"; ?>

</body>
</html>