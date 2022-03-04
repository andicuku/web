<?php
require('header.php');
include("functions/connect_db.php");
include("functions/function.php");
include("functions/sessions.php");
check_logged_in();

?>
<!-- HEADER -->
<div class="container">
    <div class="row mt-4">
        <!-- Main Area Start-->
        <div class="col-sm-8 ">
            <h1> "A | A" Blog</h1>
            <h1 class="lead text-center">A blog made by A.Cuku and A.Hyka using HTML, CSS, JS, PHP</h1>
            <?php
            global $db;
            $id = $_GET['id'];
            $sql = "SELECT * FROM Post  WHERE id= '$id'";
            $stmt = $db->query($sql);
            $Result = $stmt->rowcount();
            if ($Result != 1) {
                $_SESSION["ErrorMessage"] = "Bad Request !";
                Redirect_to("show_posts.php");
            }
            while ($row = $stmt->fetch()) {
                $post_id = $row["id"];
                $dateTime = $row["datetime"];
                $post_title = $row["title"];
                $category = $row["category"];
                $user = $row["author"];
                $image = $row["image"];
                $post_body = $row["content"];
            }

            ?>
                <div class="card bg-dark text-light text-center" style="width: 100%;">
                    <h1><?php echo $post_title; ?></h1>
                </div>
            <p class="my-2" style="float: right">Written by <?php echo $user?></p>
            <div class="card-body">
                <img src="images/<?php echo $image; ?>" class="img-fluid rounded" alt="Responsive image">
                <p class="lead mt-5 border py-5 px-5"><?php echo $post_body; ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto debitis deserunt doloremque dolores impedit itaque, labore nulla obcaecati officia officiis praesentium quibusdam quis rem rerum sed soluta temporibus totam!</p>
            </div>

        </div>
        </div>
    </div>
</div>



