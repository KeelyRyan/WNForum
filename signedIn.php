<?php
//signin.php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';
include 'functions/helperFunctionsTables.php';

    echo '<div class="row"> <div class="col-sm-6">';
    echo '<br><h3> Welcome, ' . $_SESSION['user_name'] . ' <br> <br> <a href="landing_page.php">Proceed to the forum overview</a>.</h3>';
    echo '</div>';
    echo '<div class="col-sm-6"> <img src="images/logo.png" alt="Write Now logo"> </div></div>';

include 'views/footer.php';
?>
