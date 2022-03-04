<?php
include("functions/connect_db.php");
require_once "functions/function.php";
//check_logged_in();

global $db;
$id = $_GET['id'];
$sql = "DELETE FROM Post WHERE id = $id";

$db->query($sql);

Redirect_to("show_posts.php");
