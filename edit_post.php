<?php
require('header.php');
include 'functions/connect_db.php';
include 'functions/function.php';
include 'functions/sessions.php';
check_logged_in();

?>
<?php
$search_id = $_GET["id"];
if (isset($_POST["Submit"])) {
    $post_title = $_POST["post_title"];
    $category_name = $_POST["category"];
    $content = $_POST["post_body"];

    $default_time_zone = "Europe/Berlin";
    $c_time = time();
    $date = strftime("%d / %b /%y", $c_time);

    if (empty($post_title)) {
        $_SESSION["ErrorMessage"] = "Title Cant be empty". $search_id;
        Redirect_to("edit_post.php");
    } elseif (strlen($post_title) < 5) {
        $_SESSION["ErrorMessage"] = "Post Title should be greater than 5 characters";
        Redirect_to("edit_post.php");
    } elseif (strlen($content) > 9999) {
        $_SESSION["ErrorMessage"] = "Post Description should be less than than 1000 characters";
        Redirect_to("edit_post.php");
    } else {
        // Query to Update Post in DB When everything is fine
        global $db;

        $sql = "UPDATE Post
              SET title='$post_title', category='$category_name', content='$content', datetime='$date'
              WHERE id='$search_id'";

        $Execute = $db->query($sql);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Post Updated Successfully";
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try Again !";
        }
        Redirect_to("show_posts.php");
    }
}
?>

<header class="bg-dark text-white py-4 my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <i class="fa-solid fa-blog"></i> Posts
            </div>
        </div>
    </div>
</header>
<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-lg-1 col-lg-10">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();

            global $db;
            $query = "SELECT * FROM Post where id = '$search_id'";
            $stmt = $db->query($query);
            while ($rows = $stmt->fetch()) {
                $post_title = $rows['title'];
                $post_author = $rows['author'];
                $post_date = $rows['datetime'];
                $post_content = $rows['content'];
                $post_image = $rows['image'];
                $post_category = $rows['category'];
            }


            ?>
            <form class="" action="edit_post.php?id=<?php echo $search_id; ?>"" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1 class="text-center">Edit Post</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">Post Title:</label>
                            <input class="form-control" type="text" name="post_title" id="title"
                                   placeholder="Type post title here" value="<?php echo $post_title ?>">
                        </div>
                        <div class="form-group mb-4">
                            <div class="form-group mb-4">
                                <span>Existing Category: </span> <?php echo $post_category ?>
                                <select class="form-control" name="category" id="category">
                                    <?php
                                    global $db;
                                    $sql = "SELECT id,title FROM Category;";
                                    $result = $db->query($sql);
                                    while ($row = $result->fetch()) {
                                        $category_id = $row['id'];
                                        $category_name = $row['title'];
                                        echo "<option>$category_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-file">
                                <input type="File" class="form-control form-control-lg" id="image" name="image">
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="body" class="pb-3">Post Body:</label>
                            <textarea class="form-control" name="post_body" id="body" cols="30" rows="10"
                                      placeholder="Type post body here">
                                <?php echo $post_content ?>
                            </textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <a href="dashboard.php" class="btn btn-warning px-5" style="width: 100%"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="submit" name="Submit" class="btn btn-success btn-block"
                                        style="width: 100%;">
                                    <i class="fas fa-check"></i> Publish
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
</section>
<?php
require('footer.php');
?>
