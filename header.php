<?php
include "bootstrap.php";
?>
<style>
    <?php include "css/style.css"; ?>
</style>
<div class="navbar navbar-expand bg-dark py-4" style="">
    <div class="container">
        <a href="index.php" class="navbar-brand"> <i class="fa-brands fa-amazon text-primary fa-2xl"></i> Andi | Anxhelo</a>

        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a href="index.php" class="nav-link"> <i class="fa fa-user text-success"></i> Home </a>
            </li>
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="show_posts.php" class="nav-link">Posts</a>
            </li>
            <li class="nav-item">
                <a href="categories.php" class="nav-link">Categories</a>
            </li>


        </ul>
        <ul class="navbar-nav">

            <li>
                <button class="btn-primary"><a href="login.php" class="nav-link log-out">Login <i
                                class="fa-solid fa-right-from-bracket"></i></a></button>
            </li>




        </ul>
        <ul class="navbar-nav">
            <li>
                <button class="btn-danger"><a href="logout.php" class="nav-link log-out">Logout <i
                                class="fa-solid fa-right-from-bracket"></i></a></button>
            </li>
        </ul>
    </div>
</div>

