<?php
include "functions/function.php";
$_SESSION['logged_in'] = false;
$_SESSION["username"] = null;
session_destroy();
redirect_to("index.php");
?>
