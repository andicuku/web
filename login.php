<?php
require "header.php";
include ("functions/function.php");
include ("functions/connect_db.php");
include ("functions/sessions.php");
?>
<?php
if (isset($_POST['Submit'])){
    global $db;
    $username = $_POST['username'];
    $password = $_POST['password'];



    if (empty($username) || empty($password)) {
        $_SESSION["ErrorMessage"] = "Any fields must be filled out";
        Redirect_to("login.php");
    }

    $query = "SELECT * FROM User WHERE username = '$username' AND password = '$password'";
    $smtp = $db->prepare($query);
    $smtp->execute();
    $count = $smtp->rowCount();
    if ($count == 1) {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
        Redirect_to("index.php");
    } else {
        $_SESSION["ErrorMessage"] = "Invalid username or password";
        Redirect_to("login.php");
    }
    if (isset($_SESSION['username'])) {
        Redirect_to("index.php");
    }

}
?>

<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
            <br><br><br>

            <div class="card bg-secondary text-light">
                <div class="card-header mb-2">
                    <h4>Welcome Back !</h4>
                </div>
                <div class="card-body bg-dark mt-1">
                    <?php
                    echo ErrorMessage();
                    ?>
                    <form class="mt-5 mb-2" action="login.php" method="post">
                        <div class="form-group mb-2">
                            <div class="input-group mb-3">
                                    <span class="input-group-text text-white bg-info mb-3"> <i class="fas fa-user"></i> </span>
                                <input type="text" class="form-control mb-3" name="username" id="username" value="" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                    <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password">
                            </div>
                        </div>
                        <input type="submit" name="Submit" class="btn btn-success btn-block mt-3 " value="Login">
                    </form>
                    <button class="btn btn-secondary"><a href="add_user.php">Register</a></button>
                </div>
            </div>
        </div>

    </div>

</section>

<?php
require_once "footer.php";
