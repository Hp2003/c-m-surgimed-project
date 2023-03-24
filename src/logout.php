<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['loggedIn'] == True){
    unset($_SESSION['loggedIn']);
    session_destroy();
    echo "/";
}
?>