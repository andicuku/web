<?php
$dns = 'mysql:host=localhost;dbname=blog_db';
$user = 'root';
$password = '';
try {
    $db = new PDO($dns, $user, $password);
} catch (PDOException $e) {
    echo 'Connection Refused: ' . $e->getMessage();
}
?>