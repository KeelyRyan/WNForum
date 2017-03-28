<?php
//signin.php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';
include 'functions/helperFunctionsTables.php';


    echo 'Welcome, ' . $_SESSION['user_name'] . ' <a href="landing_page.php">Proceed to the forum overview</a>.';



include 'views/footer.php';
?>
