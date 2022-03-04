<?php
require_once 'bootstrap.php';
?>
<style>
    <?php
    require_once 'css/style.css';?>
</style>
<footer class="bg-dark text-white" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="lead text-center"> Worked by Andi | Anxhelo <span id="year"></span> &copy; --All rights
                    Reserved</p>
            </div>
        </div>
    </div>
</footer>

<script>
    $("#year").text(new Date().getFullYear());



    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }</script>