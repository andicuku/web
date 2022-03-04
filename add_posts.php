<?php
require('header.php');
include 'functions/connect_db.php';
include 'functions/function.php';
include 'functions/sessions.php';
//check_logged_in();
?>
<?php
if (isset($_POST["Submit"])) {
    #variables
    $post_title = $_POST["post_title"];
    $category = $_POST['category'];
    $image = $_FILES["image"]["name"];
    $image_directory = "images/" . basename($image);
    $content = $_POST["post_body"];
    $admin = "Andi";

    #time extraction
    $default_time_zone = "Europe/Berlin";
    $c_time = time();
    $date = strftime("%B-%d-%Y", $c_time);

    # simple validations
    if (empty($post_title) || empty($category) || empty($image) || empty($content)) {
        $_SESSION["ErrorMessage"] = "Any fields must be filled out". $image_directory;
        Redirect_to("add_posts.php");
    } elseif (strlen($post_title) < 3) {
        $_SESSION["ErrorMessage"] = "Post title should be at least 2 characters";
        Redirect_to("add_posts.php");
    } elseif (strlen($content) > 999) {
        $_SESSION["ErrorMessage"] = "Post Content should be less than 999 characters";
        Redirect_to("show_posts.php");

    } else {

        global $db;
        $query = "INSERT INTO Post(title, author, content, category, datetime, image) VALUES(:post_title, :admin, :content, :category, :date, :image)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':post_title', $post_title);
        $stmt->bindValue(':admin', $admin);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':image', $image);

        $execute = $stmt->execute();


        if ($execute) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $image_directory);
            $_SESSION["SuccessMessage"] = "Post with name" . " " . $post_title . " " . "added successfully";
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
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
            ?>
            <form class="" action="add_posts.php" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1 class="text-center">Add New Post</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">Post Title:</label>
                            <input class="form-control" type="text" name="post_title" id="title"
                                   placeholder="Type post title here" value="">
                        </div>
                        <div class="form-group mb-4">
                            <label for="category" class="pb-3">Category Title:</label>
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
                        <div class="form-group mb-4">
                            <div class="custom-file">
                                <input type="File" class="form-control form-control-lg" id="image" name="image">
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="body" class="pb-3">Post Body:</label>
                            <textarea class="form-control" name="post_body" id="body" cols="30" rows="10"
                                      placeholder="Type post body here"></textarea>
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
