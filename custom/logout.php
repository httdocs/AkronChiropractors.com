<?php
// i will keep yelling this
// DON'T FORGET TO START THE SESSION !!!
session_start();
# version 2.0 #
// if the user is logged in, unset the session
if (isset($_SESSION['basic_is_logged_in'])) {
   unset($_SESSION['basic_is_logged_in']);
}

// now that the user is logged out,
// go to login page
header('Location: ../index.php');
?>