<?php
require('header.php');
require_once('functions/connect_db.php');
require_once('functions/function.php');
require_once('functions/sessions.php');
check_logged_in();

?>
<?php
if (isset($_POST["Submit"])) {
    $category = $_POST["category_title"];
    $Admin = "Andi";
    $default_time_zone = "Europe/Berlin";
    $c_time = time();
    $date = strftime("%B-%d-%Y %H:%M:%S", $c_time);
    if (empty($category)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("categories.php");
    } elseif (strlen($category) < 3) {
        $_SESSION["ErrorMessage"] = "Category title should be at least 2 characters";
        Redirect_to("categories.php");
    } elseif (strlen($category) > 49) {
        $_SESSION["ErrorMessage"] = "Category title should be less than 50 characters";
        Redirect_to("categories.php");
    } else {
        global $db;
        $query = "INSERT INTO Category(title,author,datetime  ) VALUES(:category, :Admin, :date)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':Admin', $Admin);
        $stmt->bindValue(':date', $date);
        $execute = $stmt->execute();
        echo "executed" . $execute;
        if ($execute) {
            $_SESSION["SuccessMessage"] = "Category with name" . $category . "added successfully";
            Redirect_to("categories.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
            Redirect_to("categories.php");
        }

    }
}
?>

<header class="bg-dark text-white py-4 my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <i class="fas fa-cog"></i> Categories
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
            <form class="" action="categories.php" method="post">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Add New Category</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group mb-4">
                            <label for="title" class="pb-3">Category Title:</label>
                            <input class="form-control" type="text" name="category_title" id="title"
                                   placeholder="Type title here" value="">
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
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
require('footer.php');
?>
