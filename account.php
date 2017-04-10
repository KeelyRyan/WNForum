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
  echo '<h5>'.$fname . ' ' .$surname .'</h5>';
  echo '<h5>Username: '.$user_name.' </h5>';
  echo '<h5>User level: '.$level.' </h5>';
  echo '<h5>E-mail address: '.$email.' </h5>';
  echo '<h5>Joined community on: '.$user_date.' </h5>';

}
}
}
else
{
    echo '<h3> Sorry, you need to <a href="signin.php">signed in</a> or <a href="/forum/create_account.php">create an account</a> to access this area! </h3> ';
}
include 'views/footer.php';
?>
