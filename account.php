<?php
include 'connect.php';
include 'views/header.php';
include 'functions/helperFunctionsDatabase.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{

  $user_id=($_SESSION['user_id']);

  $sqlData = "SELECT user_name, fname, surname, user_email, user_date, user_level
              FROM users
              WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $sqlData);
if(!$result)
{
    //something went wrong, display the error
    echo 'Error signing in. Please try again.';

}
else{
while($row = mysqli_fetch_assoc($result))
{
    $user_name = $row['user_name'];
    $fname = $row['fname'];
    $surname = $row['surname'];

    $email  = $row['user_email'];
    $user_date = $row['user_date'];
if($row['user_level']==1){
    $level = "administrator";
  }
    else {
      $level = "User";
  }
  echo '<h5><b>'.$fname . ' ' .$surname .' </b></h5>';
  echo '<hr>';
  echo '<div class="row">';
  echo '<div class="col-sm-6">';
  echo '<div class="row">
  <div class="col-sm-6">
  <dl>
  <dt><h5><b>Username: </b> </dt> <dd>'.$user_name.' </h5></dd></div>';
  echo '<div class="col-sm-6">
  <dt><h5><b>User level:</b> </dt> <dd> '.$level.' </h5></dd></div></div>';
  echo '<div class="row">
  <div class="col-sm-6">
  <dt><h5><b>E-mail address:</b> </dt> <dd>'.$email.' <a href="editEmail.php"><u>update</u></a>.</h5></dd></div> ';
  echo '<div class="col-sm-6">
  <dt><h5><b>Joined community on:</b> </dt> <dd>'.$user_date.' </h5> </dd></dl></div></div>';
  echo '<div class="row">
  <div class="col-sm-6">
  <br><h5><b>Update Password: </b>Click <a href="editPass.php"><u>here</u></a>. </h5> </div>';
  echo '<div class="col-sm-6">
  <br><h5><b>Cancel Account: </b>Click <a href="deleteAcc.php"><u>here</u></a>. </h5> </div>';
  echo '</div> </div>';

    }
  }
}
else
{
    echo '<h3> Sorry, you need to <a href="signin.php">signed in</a> or <a href="/forum/create_account.php">create an account</a> to access this area! </h3> ';
}
echo '<div class="col-sm-6">
<img src="images/logo.png" alt="Write Now logo">
</div></div>';
include 'views/footer.php';
?>
