<?php
require_once "header.php";
include "functions/connect_db.php";
include "functions/sessions.php";
require_once "functions/function.php";
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
                <h1 class="py-3"><i class="fas fa-user" style="color:#27aae1;"></i> User Management</h1>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Action</th>

                    <!--                    <th>Live Preview</th>-->
                </tr>
                </thead>
                <?php
                global $db;
                $sql  = "SELECT * FROM User ORDER BY id desc";
                $stmt = $db->query($sql);
                $cnt = 0;
                while ($row = $stmt->fetch()) {
                    $Id        = $row["id"];
                    $first_name  = $row["first_name"];
                    $last_name = $row["last_name"];
                    $username  = $row["username"];
                    $gender     = $row["gender"];
                    $password = $row['password'];
                    $cnt++;
                    ?>
                    <tbody>
                    <tr>
                        <td>
                            <?php echo $cnt; ?>
                        </td>
                        <td>
                            <?php
                            echo $first_name;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $last_name ;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $username;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $gender ;
                            ?>
                        </td>
                        <td>
                            <a href="delete_user.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
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
