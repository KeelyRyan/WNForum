<?php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';

echo '<div class="row"> <div class="col-sm-6">';
include 'forms/delete.html';

if(isset($_POST['user_password']))
{

$user_pass=$conn->real_escape_string(sha1($_POST['user_password']));
$user_id=($_SESSION['user_id']);

$sql = "DELETE FROM users
        WHERE user_id = $user_id AND user_password = '$user_pass';";

if(query($conn,$sql)==1)
{
echo "<script type='text/javascript'>alert('Account deleted!')</script>";


    session_destroy();
    header('Location: signin.php');
    exit;
}
else{
echo 'Error' . mysqli_error($conn);
}
}
echo '</div> <div class="col-sm-6">';
echo '<img src="images/logo.png" alt="Write Now logo">
</div></div>';



include 'views/footer.php';
?>
