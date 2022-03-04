<?php
function redirect_to($location) {
    header("Location: $location");
    exit;
}

function check_logged_in(){
    if (!$_SESSION['username'] || !$_SESSION['logged_in']) {
        header("Location: login.php");
        exit;
    }
}