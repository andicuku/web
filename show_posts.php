<?php
require_once "header.php";
include "functions/connect_db.php";
require_once "functions/function.php";
include "functions/sessions.php";
check_logged_in();

?>

<style>
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 80vh;
    }

</style>
<header class="bg-dark text-white" style="margin-top: 2em ">
    <div class="container">
        <div class="row my-2">
            <div class="col-md-12">
                <h1 class="py-3"><i class="fas fa-blog" style="color:#27aae1;"></i> Blog Posts</h1>
                <?php
                ?>
            </div>
            <div class="col-lg-4 mb-2 pb-5 pl-5">
                <a href="add_posts.php" class="btn btn-success btn-block">
                    <i class="fas fa-edit"></i> Add New Post
                </a>
            </div>
            <div class="col-lg-4 mb-2">
                <a href="categories.php" class="btn btn-info btn-block">
                    <i class="fas fa-folder-plus"></i> Add New Category
                </a>
            </div>
            <div class="col-lg-4 mb-2">
                <a href="add_user.php" class="btn btn-light btn-block">
                    <i class="fas fa-user-plus"></i> Add New User
                </a>
            </div>
            </div>
        </div>
    </div>
</header>
<section class="container py-2 mb-4">
    <div class="row">
        <div class="col-lg-12">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date&Time</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Actions</th>
                    <th>View</th>
                    <!--                    <th>Live Preview</th>-->
                </tr>
                </thead>
                <?php
                global $db;
                $sql  = "SELECT * FROM Post ORDER BY id desc";
                $stmt = $db->query($sql);
                $Sr = 0;
                while ($row = $stmt->fetch()) {
                    $Id        = $row["id"];
                    $date_time  = $row["datetime"];
                    $post_title = $row["title"];
                    $category  = $row["category"];
                    $user     = $row["author"];
                    $image     = $row["image"];
                    $Sr++;
                    ?>
                    <tbody>
                    <tr>
                        <td>
                            <?php echo $Sr; ?>
                        </td>
                        <td>
                            <?php
                            if(strlen($post_title)>20){$PostTitle= substr($post_title,0,18).'..';}
                            echo $post_title;
                            ?>
                        </td>
                        <td>
                            <?php
                            if(strlen($category)>8){$Category= substr($category,0,8).'..';}
                            echo $category ;
                            ?>
                        </td>
                        <td>
                            <?php
                            if(strlen($date_time)>11){$DateTime= substr($date_time,0,11).'..';}
                            echo $date_time ;
                            ?>
                        </td>
                        <td>
                            <?php
                            if(strlen($user)>6){$Admin= substr($user,0,6).'..';}
                            echo $user ;
                            ?>
                        </td>
                        <td><img src="images/<?php echo $image ; ?>" width="170px;" height="50px"</td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $Id; ?>"><span class="btn btn-success">Edit</span></a>
                            <a href="delete_post.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                        </td>
                        <td>
                            <a href="full_post.php?id=<?php echo $Id; ?>"><span class="btn btn-primary">Live Preview</span></a>
                        </td>

                    </tr>
                    </tbody>
                <?php } ?>   <!--  Ending of While loop -->
            </table>
        </div>
    </div>
</section>
<?php
require_once "footer.php";
?>
