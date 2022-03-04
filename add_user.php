<?php
require('header.php');
include 'functions/connect_db.php';
include 'functions/function.php';
include 'functions/sessions.php';
?>
<?php
if (isset($_POST["Submit"])) {
    #variables
    $first_name = $_POST["first_name"];
    $last_name = $_POST['last_name'];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];


    # simple validations
    if (empty($username) || empty($password)) {
        $_SESSION["ErrorMessage"] = "Any fields must be filled out";
        Redirect_to("add_posts.php");
    } elseif (strlen($username) < 3) {
        $_SESSION["ErrorMessage"] = "Username title should be at least 3 characters";
        Redirect_to("add_posts.php");
    } elseif (strlen($password) < 8) {
        $_SESSION["ErrorMessage"] = "Password shouldn't be less than 8 characters";
        Redirect_to("show_posts.php");

    } else {

        global $db;
        $query = "INSERT INTO User(first_name, last_name, username, password, gender) VALUES(:first_name, :last_name, :username, :password, :gender)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':first_name', $first_name);
        $stmt->bindValue(':last_name', $last_name);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':gender', $gender);

        $execute = $stmt->execute();


        if ($execute) {
            $_SESSION["SuccessMessage"] = "User with username" . " " . $username . " " . "added successfully";
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        }
        Redirect_to("dashboard.php");

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
            <form class="" action="add_user.php" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1 class="text-center">Add New User</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">First Name</label>
                            <input class="form-control" type="text" name="first_name" id="title"
                                   placeholder="First Name" value="">
                        </div>
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="title"
                                   placeholder="Last Name" value="">
                        </div>
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">Username</label>
                            <input class="form-control" type="text" name="username" id="title"
                                   placeholder="Username" value="">
                        </div>
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">Password</label>
                            <input class="form-control" type="text" name="password" id="title"
                                   placeholder="Password" value="">
                        </div>
                        <div class="form-group mb-4">
                            <label for="category" class="pb-3">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">M</option>
                                <option value="">F</option>
                            </select>
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
